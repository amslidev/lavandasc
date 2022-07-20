<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Cortesiaproducto;
use LavandaBundle\Form\CortesiaproductoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class CortesiaProductoController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction($idcortesia)
    {
        $em = $this->getDoctrine()->getManager();

        $cortesia = $em->getRepository('LavandaBundle:Cortesias')->find($idcortesia);

        $productos = $em->getRepository('LavandaBundle:Cortesiaproducto')->findBy([
            "idcortesia" => $idcortesia
        ]);

        return $this->render('LavandaBundle:CortesiaProducto:index.html.twig', [
            "cortesia" => $cortesia,
            "productos" => $productos
        ]);
    }

    public function saveProductsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $arrProductos = json_decode($request->request->get('productos'), true);
        $cortesia = $em->getRepository('LavandaBundle:Cortesias')->find($request->request->get('idcortesia'));

        $response = new Response();

        try{
            foreach ($arrProductos as $producto){
                if($producto != null){
                    //Buscar si el producto ya fue asignado al servicio
                    $productoentity = $em->getRepository('LavandaBundle:Producto')->find($producto["idproducto"]);

                    $cortesiaproducto = $em->getRepository('LavandaBundle:Cortesiaproducto')->findOneBy([
                        "idcortesia" => $cortesia->getIdcortesia(),
                        "idproducto" => $productoentity->getIdproducto()
                    ]);


                    if($cortesiaproducto == null){
                        $cortesiaproducto = new Cortesiaproducto();
                        $cortesiaproducto->setIdcortesia($cortesia);
                        $cortesiaproducto->setIdproducto($productoentity);
                        $cortesiaproducto->setCantidad($producto["cantidad"]);

                        $em->persist($cortesiaproducto);
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

    public function editAction(Request $request, $idcortesiaproducto){
        $em = $this->getDoctrine()->getManager();

        $cortesiaproducto = $em->getRepository('LavandaBundle:Cortesiaproducto')->find($idcortesiaproducto);

        $cortesia = $cortesiaproducto->getIdcortesia();
        $producto = $cortesiaproducto->getIdproducto();

        $form = $this->createForm(CortesiaproductoType::class, $cortesiaproducto);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                try{
                    $em->persist($cortesiaproducto);
                    $em->flush();

                    $status = "Cambios guardados correctamente";
                    $this->session->getFlashBag()->add("info","success");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("cortesiaproducto_index", array("idcortesia" => $cortesia->getIdcortesia()));
                }catch (\Exception $e){
                    $status = $e->getMessage();
                    $this->session->getFlashBag()->add("info","error");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("cortesiaproducto_index", array("idcortesia" => $cortesia->getIdcortesia()));
                }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("cortesiaproducto_index", array("idcortesia" => $cortesia->getIdcortesia()));
            }
        }

        return $this->render('LavandaBundle:CortesiaProducto:edit.html.twig', [
            "form" => $form->createView(),
            "cortesiaproducto" => $cortesiaproducto
        ]);
    }
}
