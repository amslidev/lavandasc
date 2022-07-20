<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Servicioproducto;
use LavandaBundle\Form\ServicioproductoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ServicioProductoController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction($idservicio)
    {
        $em = $this->getDoctrine()->getManager();

        $servicio = $em->getRepository('LavandaBundle:Servicio')->find($idservicio);

        $productos = $em->getRepository('LavandaBundle:Servicioproducto')->findBy([
            "idservicio" => $idservicio
        ]);

        return $this->render('LavandaBundle:ServicioProducto:index.html.twig', [
            "productos" => $productos,
            "servicio" => $servicio
        ]);
    }

    public function saveProductsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $arrProductos = json_decode($request->request->get('productos'), true);
        $servicio = $em->getRepository('LavandaBundle:Servicio')->find($request->request->get('idservicio'));

        $response = new Response();

        try{
            foreach ($arrProductos as $producto){
                if($producto != null){
                    //Buscar si el producto ya fue asignado al servicio
                    $productoentity = $em->getRepository('LavandaBundle:Producto')->find($producto["idproducto"]);

                    $servicioproducto = $em->getRepository('LavandaBundle:Servicioproducto')->findOneBy([
                        "idservicio" => $servicio->getIdservicio(),
                        "idproducto" => $productoentity->getIdproducto()
                    ]);


                    if($servicioproducto == null){
                        $servicioproductoentity = new Servicioproducto();
                        $servicioproductoentity->setIdservicio($servicio);
                        $servicioproductoentity->setIdproducto($productoentity);
                        $servicioproductoentity->setCantidad($producto["cantidad"]);

                        $em->persist($servicioproductoentity);
                        $em->flush();
                    }
                }
            }
            $response->setStatusCode(200);
            $response->setContent("Productos registrados correctamente");
        }catch (\Exception $e){
            $response->setStatusCode(500);
            $response->setContent($e->getMessage());
        }

        return $response;
    }

    public function editAction(Request $request, $idservicioproducto)
    {
        $em = $this->getDoctrine()->getManager();

        $servicioproducto = $em->getRepository('LavandaBundle:Servicioproducto')->find($idservicioproducto);

        $servicio = $servicioproducto->getIdservicio();
        $producto = $servicioproducto->getIdproducto();

        $form = $this->createForm(ServicioproductoType::class, $servicioproducto);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
               try{
                   $em->persist($servicioproducto);
                   $em->flush();

                   $status = "Cambios guardados correctamente";
                   $this->session->getFlashBag()->add("info","success");
                   $this->session->getFlashBag()->add("status",$status);
                   return $this->redirectToRoute("servicioproducto_index", array("idservicio" => $servicio->getIdservicio()));
               }catch (\Exception $e){
                   $status = $e->getMessage();
                   $this->session->getFlashBag()->add("info","error");
                   $this->session->getFlashBag()->add("status",$status);
                   return $this->redirectToRoute("servicioproducto_index", array("idservicio" => $servicio->getIdservicio()));
               }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("servicioproducto_index", array("idservicio" => $servicio->getIdservicio()));
            }
        }

        return $this->render('LavandaBundle:ServicioProducto:edit.html.twig', [
            "form" => $form->createView(),
            "servicioproducto" => $servicioproducto
        ]);
    }

    public function deleteAction($idservicioproducto, $idservicio)
    {
        $em = $this->getDoctrine()->getManager();

        $servicio = $em->getRepository('LavandaBundle:Servicio')->find($idservicio);
        $servicioproducto = $em->getRepository('LavandaBundle:Servicioproducto')->find($idservicioproducto);

        if($servicioproducto != null){
            $em->remove($servicioproducto);
            $em->flush();

            $status = "Producto eliminado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);

        }else{
            $status = "No se encontró información del producto";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);

        }

        return $this->redirectToRoute("servicioproducto_index", array("idservicio" => $servicio->getIdservicio()));
    }

}
