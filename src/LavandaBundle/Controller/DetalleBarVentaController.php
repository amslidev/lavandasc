<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Detallebarventa;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DetalleBarVentaController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function registrarCortesiasVentaAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idorden = $request->request->get('idorden');
        $idcortesia = $request->request->get('idcortesia');
        $cantidad = $request->request->get('cantidad');

        $data = [];

        if($idorden != "" && $idcortesia != "" && $cantidad != ""){
            try {
                $orden = $em->getRepository('LavandaBundle:Barventa')->find($idorden);
                $cortesia = $em->getRepository('LavandaBundle:Cortesias')->find($idcortesia);

                //Verificar si la cortesía ya fue agregada a la orden actual
                $detalleventa = $em->getRepository('LavandaBundle:Detallebarventa')->findOneBy([
                    "idbarventa" => $orden->getIdbarventa(),
                    "idcortesia" => $cortesia->getIdcortesia()
                ]);

                if($detalleventa == null){
                    //Obtener la cantidad que se ofrece como cortesía
                    $cantidadCortesia = $cortesia->getCantidadcortesia();

                    $subtotal = 0;

                    if($cantidad > $cantidadCortesia){
                        $subtotal = ($cantidad - $cantidadCortesia) * $cortesia->getPrecio();
                    }

                    $detalleventa = new Detallebarventa();
                    $detalleventa->setIdbarventa($orden);
                    $detalleventa->setIdcortesia($cortesia);
                    $detalleventa->setCantidad($cantidad);
                    $detalleventa->setSubtotal($subtotal);

                    //Actualizar el stock de los productos
                    $actualizarStock = $this->get('arsc.actualizar_stock_service');
                    $actualizarStock->decrementarStockBar($detalleventa, $cantidad);


                    $em->persist($detalleventa);
                    $em->flush();

                    //Actualizar el total de la orden
                    $actualizarTotal = $this->get('arsc.actualizar_totales_service');
                    $actualizarTotal->actualizarTotales($idorden);
                }else{
                    //Obtener la cantidad que se ofrece como cortesía
                    $cantidadCortesia = $cortesia->getCantidadcortesia();
                    $cantidadActual = $detalleventa->getCantidad();
                    $cantidadDespachada = $cantidadActual + $cantidad;
                    $detalleventa->setCantidad($cantidadDespachada);

                    $subtotal = 0;

                    if($cantidadDespachada > $cantidadCortesia){
                        $subtotal = ($cantidadDespachada - $cantidadCortesia) * $cortesia->getPrecio();
                    }

                    $detalleventa->setSubtotal($subtotal);
                    $em->persist($detalleventa);
                    $em->flush();
                    //Actualizar el stock de los productos
                    $actualizarStock = $this->get('arsc.actualizar_stock_service');
                    $actualizarStock->decrementarStockBar($detalleventa, ($detalleventa->getCantidad() - $cantidadActual ));
                    //Actualizar el total de la orden
                    $actualizarTotal = $this->get('arsc.actualizar_totales_service');
                    $actualizarTotal->actualizarTotales($idorden);
                }
                //$arrDetalles = $this->listarProductosVenta($orden->getIdbarventa());
                $data[]  =[
                    "status" => "success",
                    "mensaje" => "Producto agregado correctamente"
                ];
            }catch (\Exception $e){
                $data[]  =[
                    "status" => "Error",
                    "mensaje" => $e->getMessage()
                ];
            }
        }else{
            $data[]  =[
                "status" => "Error",
                "mensaje" => "Faltan datos"
            ];
        }

        return new JsonResponse($data);
    }

    public function listarProductosVentaAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idorden = $request->get('idorden');

        $productos = $em->getRepository('LavandaBundle:Detallebarventa')->findBy([
            "idbarventa" => $idorden
        ]);

        $arrProductos = [];

        foreach ($productos as $producto){
            $arrProductos[] = [
                "iddetalle" => $producto->getIddetallebarventa(),
                "nombre" => $producto->getIdcortesia()->getNombre(),
                "cantidad" => $producto->getCantidad(),
                "precio" => $producto->getIdcortesia()->getPrecio(),
                "subtotal" => $producto->getSubtotal()
            ];
        }

        return new JsonResponse($arrProductos);
    }

    public function cargarInfoDetalleAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $iddetalle = $request->get('iddetalle');

        $data = [];

        if($iddetalle != ""){
            $detallebarventa = $em->getRepository('LavandaBundle:Detallebarventa')->find($iddetalle);

            if($detallebarventa != null){

                $arrInfo = [
                    "iddetalle" => $detallebarventa->getIddetallebarventa(),
                    "noorden" => $detallebarventa->getIdbarventa()->getNoorden(),
                    "producto" => $detallebarventa->getIdcortesia()->getNombre(),
                    "cantidad" => $detallebarventa->getCantidad()
                ];

                $data[] = [
                    "status" => "success",
                    "data" => $arrInfo
                ];
            }else{
                $data[] = [
                    "status" => "success",
                    "data" => "No se encontró información"
                ];
            }
        }else{
            $data[] = [
              "status" => "Error",
              "data" => "Faltan datos"
            ];
        }
        return new JsonResponse($data);
    }

    public function editarDetalleOrdenAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $iddetalle = $request->request->get('iddetalle');
        $cantidad = $request->request->get('cantidad');

        $response = new Response();

        if($iddetalle != "" && $cantidad != ""){
            $detalle = $em->getRepository('LavandaBundle:Detallebarventa')->find($iddetalle);

            if($detalle != null){
                //Obtener la cortesia
                $cortesia = $detalle->getIdcortesia();
                //Obtener la cantidad que se ofrece como cortesía
                $cantidadCortesia = $cortesia->getCantidadcortesia();
                //Obtener la cantidad actual que está registrada
                $cantidadActual = $detalle->getCantidad();
                $diferencia = 0;
                //Actualizar el stock de los productos
                $actualizarStock = $this->get('arsc.actualizar_stock_service');
                if($cantidadActual < $cantidad){
                    $diferencia = $cantidad - $cantidadActual;
                    $actualizarStock->decrementarStockBar($detalle, $diferencia);
                }else{
                    $diferencia = $cantidadActual - $cantidad;
                    $actualizarStock->incrementarStockBar($detalle, $diferencia);
                }

                //Calcular el subtotal
                $subtotal = ($cantidad - $cantidadCortesia) * $cortesia->getPrecio();
                $detalle->setSubtotal($subtotal);

                //Actualizar el total de la orden
                $actualizarTotal = $this->get('arsc.actualizar_totales_service');
                $actualizarTotal->actualizarTotales($detalle->getIdbarventa()->getIdbarventa());

                //Persistir el objeto
                $detalle->setCantidad($cantidad);
                $em->persist($detalle);
                $em->flush();
            }else{
                $response->setStatusCode(500);
                $response->setContent("No se encontró información");
            }
        }else{
            $response->setStatusCode(500);
            $response->setContent("Faltan datos");
        }
        return $response;
    }

    public function eliminarProductoDetalleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $iddetallebarventa = $request->get("iddetalle");

        $detallebarventa = $em->getRepository('LavandaBundle:Detallebarventa')->find($iddetallebarventa);

        $response = new Response();
        if($detallebarventa){
            try {
                $cantidad = $detallebarventa->getCantidad();
                $em->remove($detallebarventa);
                $em->flush();

                //Actualizar el stock de los productos
                $actualizarStock = $this->get('arsc.actualizar_stock_service');
                $actualizarStock->incrementarStockBar($detallebarventa, $cantidad);

                //Actualizar el total de la orden
                $actualizarTotal = $this->get('arsc.actualizar_totales_service');
                $actualizarTotal->actualizarTotales($detallebarventa->getIdbarventa()->getIdbarventa());

                $response->setStatusCode(200);
                $response->setContent("Producto eliminado correctamente");
            }catch (\Exception $e){
                $response->setStatusCode(500);
                $response->setContent("Error al intentar eliminar el detalle");
            }
        }else{
            $response->setStatusCode(404);
            $response->setContent("No se encontró información de detalle");
        }

        return $response;
    }

}
