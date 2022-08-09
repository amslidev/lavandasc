<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Barventa;
use LavandaBundle\Entity\Sucursal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class BarVentaController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function listarOrdenesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //Obtener el rol del usuario para determinar si se muestran todas las órdenes o solo las de su sucursal
        $user = $this->getUser();
        $role = $user->getRole();

        $arrOrdenes = [];
        //Buscar el estatus con clave EV1 = Nueva
        $estatus = $em->getRepository('LavandaBundle:Estatusventa')->findOneBy([
            "clave" => "EV1"
        ]);

        $ordenes = null;
        if($role == "ROLE_ADMIN"){
            $ordenes = $em->getRepository('LavandaBundle:Barventa')->findBy([
                "idestatus" => $estatus->getIdestatusventa()
            ]);

        }else if($role == "ROLE_USER"){
            //Buscar la sucursal del usuario
            $sucursal = $user->getIdsucursal();

            $ordenes = $em->getRepository('LavandaBundle:Barventa')->findBy([
                "idestatus" => $estatus->getIdestatusventa(),
                "idsucursal" => $sucursal->getIdsucursal()
            ]);
        }

        foreach ($ordenes as $orden){
            $arrOrdenes[] = [
                "idorden" => $orden->getIdbarventa(),
                "noorden" => $orden->getNoorden(),
                "cliente" => $orden->getIdcliente()->getNombre()." ".$orden->getIdcliente()->getApellido(),
                "fecha" => date_format($orden->getFecha(), "d-m-Y")
            ];
        }
        rsort($arrOrdenes);

        return new JsonResponse($arrOrdenes);
    }

    public function registroOrdenAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        //Verificar el rol del usuario para determinar si se debe haber enviado la sucursal
        //en caso de que sea un rol admin o si se busca la sucursal si el usuario tiene el role_user
        $user = $this->getUser();
        $role = $user->getRole();

        $idsucursal = $request->request->get('idsucursal');
        $idcliente = $request->request->get('idcliente');

        $response = new Response();

        if($role == "ROLE_ADMIN"){
            if($idsucursal != ""){
                $sucursal = $em->getRepository('LavandaBundle:Sucursal')->find($idsucursal);
            }else{
                $response->setStatusCode(500);
                $response->setContent("Debe seleccionar la sucursal");
            }
        }else if($role == "ROLE_USER"){
            $sucursal = $em->getRepository('LavandaBundle:Sucursal')->find($user->getIdsucursal()->getIdsucursal());
        }

        if($sucursal != null){
            $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

            try {
                $noorden = $this->generarNoOrden($sucursal);

                $estatus = $em->getRepository('LavandaBundle:Estatusventa')->findOneBy([
                    "clave" => "EV1"
                ]);

                $barventa = new Barventa();
                $barventa->setIdcliente($cliente);
                $barventa->setIdsucursal($sucursal);
                $barventa->setFecha(new \DateTime("now"));
                $barventa->setNoorden($noorden);
                $barventa->setIdestatus($estatus);
                $barventa->setIdusuario($user);
                $barventa->setDescuento(0);

                $em->persist($barventa);
                $em->flush();
                $idbarventa = $barventa->getIdbarventa();
                $response->setContent(200);
                $response->setContent($idbarventa.".".$noorden);
            }catch (\Exception $e){
                $response->setContent(500);
                echo $e->getMessage();
            }
        }
        return $response;
    }

    public function generarNoOrden(Sucursal $sucursal){
        $em = $this->getDoctrine()->getManager();
        try {
            $claveSuc = $sucursal->getClave();
            $dql = "SELECT max(o.noorden) FROM LavandaBundle:Barventa o WHERE o.noorden LIKE '$claveSuc%'";
            $query = $em->createQuery($dql);

            $dato = $query->getResult();
            $current_year = date("y");
            $nueva_secuencia = "";
            $clave = "";
            if($dato[0][1] != null){
                $numorden = $dato[0][1];
                $arrCad = explode("-", $numorden);
                $ordenSuc = $arrCad[0];
                $secuencia = $arrCad[1];
                $year = substr($ordenSuc, -2);

                if($year == $current_year && $secuencia >= 1){
                    $cad1 = $claveSuc.$year;
                    $nueva_secuencia = ($secuencia >= 1 && $secuencia <= 999) ? str_pad($secuencia + 1, 4,"0", STR_PAD_LEFT) : $nueva_secuencia = $secuencia + 1;
                }else{
                    $nueva_secuencia = str_pad(1, 4,"0", STR_PAD_LEFT);
                    $cad1 = $claveSuc.$current_year;
                }
                $noorden = $cad1."-".$nueva_secuencia;
            }else{
                $nueva_secuencia = str_pad(1, 4,"0", STR_PAD_LEFT);
                $noorden = $claveSuc.$current_year."-".$nueva_secuencia;
            }
        }catch (\Exception $e){
            echo $e->getMessage();
        }
        return $noorden;
    }

    public function mostrarMontosOrdenAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idorden = $request->get('idorden');

        $orden = $em->getRepository('LavandaBundle:Barventa')->find($idorden);

        $data = [];

        if($orden){
            $detalles = $em->getRepository('LavandaBundle:Detallebarventa')->findBy([
                "idbarventa" => $orden->getIdbarventa()
            ]);

            $subtotal = 0;

            foreach ($detalles as $detalle){
                $subtotal += $detalle->getSubtotal();
            };

            $data[] = [
                "status" => "success",
                "data" => [
                    "idbarventa" => $orden->getIdbarventa(),
                    "subtotal" => $subtotal,
                    "total" => $orden->getTotal(),
                    "descuento" => $orden->getDescuento()
                ]
            ];
        }else{
            $data = [
                "status" => "Error",
                "data" => "No se encontró información de la orden"
            ];
        }

        return new JsonResponse($data);
    }
    public function actualizarDescuentoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idorden = $request->request->get('idorden');
        $descuento = $request->request->get('descuento');

        $data = [];
        if($idorden != "" && $descuento != ""){
            $orden = $em->getRepository('LavandaBundle:Barventa')->find($idorden);
            if($orden != null){
                try{
                    $orden->setDescuento($descuento);
                    $em->persist($orden);
                    $em->flush();

                    //Actualizar el total de la orden
                    $actualizarTotal = $this->get('arsc.actualizar_totales_service');
                    $actualizarTotal->actualizarTotales($idorden);

                    $data[] = [
                        "status" => "success",
                        "data" => "Descuento editado correctamente"
                    ];
                }catch (\Exception $e){
                    $data[] = [
                        "status" => "Error",
                        "data" => $e->getMessage()
                    ];
                }
            }else{
                $data[] = [
                    "status" => "Error",
                    "data" => "No se encontró información de la orden"
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

    public function cancelarOrdenAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idorden = $request->get('idorden');
        $data =[];
        if($idorden != ""){
            $orden = $em->getRepository('LavandaBundle:Barventa')->find($idorden);
            if($orden != null){
                try {
                    //Buscar el estatus para la orden
                    $estatus = $em->getRepository('LavandaBundle:Estatusventa')->findOneBy([
                        "clave" => "EV3"
                    ]);
                    $orden->setIdestatus($estatus);

                    //Buscar todos los items de la orden
                    $detalles = $em->getRepository('LavandaBundle:Detallebarventa')->findBy([
                        "idbarventa" => $orden->getIdbarventa()
                    ]);

                    foreach ($detalles as $detalle){
                        $cantidad = $detalle->getCantidad();
                        $em->remove($detalle);
                        $em->flush();

                        $user = $this->getUser();

                        $bitacora = $this->get('arsc.bitacora_ventas');
                        $evento = "Se canceló la orden de venta no: " . $orden->getNoorden()." por el usuario " . $user->getUsername();
                        $bitacora->registrarEvento($orden, $evento, $user->getIdusuario());

                        //Actualizar el stock de los productos
                        $actualizarStock = $this->get('arsc.actualizar_stock_service');
                        $actualizarStock->incrementarStockBar($detalle, $cantidad);
                    }

                    $em->persist($orden);
                    $em->flush();

                    $data[] = [
                        "status" => "success",
                        "data" => "Orden cancelada correctamente"
                    ];

                }catch (\Exception $e){
                    $data[] = [
                        "status" => "Error",
                        "data" => $e->getMessage()
                    ];
                }
            }else{
                $data[] = [
                    "status" => "Error",
                    "data" => "No se encontró información de la orden"
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

    public function mostrarInfoOrdenAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idorden = $request->get('idorden');

        $data = [];
        if($idorden != ""){
            $orden = $em->getRepository('LavandaBundle:Barventa')->find($idorden);
            if($orden != null){
                $data[] = [
                    "status" => "success",
                    "data" => [
                        "idorden" => $orden->getIdbarventa(),
                        "noorden" => $orden->getNoorden(),
                        "cliente" => $orden->getIdcliente()->getNombre()." ".$orden->getIdcliente()->getApellido(),
                        "fecha" => date_format($orden->getFecha(),"d-m-Y H:i"),
                        "total" => $orden->getTotal()
                    ]
                ];
            }else{
                $data[] = [
                    "status" => "Error",
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

    public function cerrarOrdenAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $idorden = $request->get('idorden');
        $idforma = $request->get('idforma');

        $data = [];

        if($idorden != ""){
            $orden = $em->getRepository('LavandaBundle:Barventa')->find($idorden);
            if($orden != null){
                try {
                    //Buscar el estatus de Cerrada para la orden
                    $estatus = $em->getRepository('LavandaBundle:Estatusventa')->findOneBy([
                        "clave" => "EV2"
                    ]);

                    //Buscar la forma de pago seleccionada
                    $forma = $em->getRepository('LavandaBundle:Formaspago')->find($idforma);

                    $orden->setIdformapago($forma);
                    $orden->setIdestatus($estatus);
                    $orden->setFechacierre(new \DateTime("now"));
                    $em->persist($orden);
                    $em->flush();

                    $user = $this->getUser();

                    $bitacora = $this->get('arsc.bitacora_ventas');
                    $evento = "Se cerró la orden de venta no: " . $orden->getNoorden()." por el usuario " . $user->getUsername();
                    $bitacora->registrarEvento($orden, $evento, $user->getIdusuario());

                    $data [] = [
                        "status" => "success",
                        "data" => "Orden cerrada correctamente"
                    ];

                }catch (\Exception $e){
                    $data[] = [
                        "status" => "Error",
                        "data" => $e->getMessage()
                    ];
                }
            }else{
                $data[] = [
                    "status" => "Error",
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
}
