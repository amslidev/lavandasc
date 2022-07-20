<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Producto;
use LavandaBundle\Form\ProductoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ProductosController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(){
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('LavandaBundle:Producto')->findAll();

        return $this->render('LavandaBundle:Productos:index.html.twig', array(
            "productos"=>$productos
        ));
    }

    public function newAction(Request $request){
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $base = "uploads/productos/";
            $path = $base.$producto->getNombre()."/";

            if(!file_exists($path)){
                mkdir($path, 777, true);
            }

            $foto = $form["foto"]->getData();
            if(!empty($foto) && $foto != null){
                $ext = $foto->guessExtension();
                $file_name = time().".".$ext;
                $producto->setRutaimagen($path);
                $producto->setNombreimagen($file_name);
                $foto->move($path, $file_name);
            }

            $producto->setFechaalta(new \DateTime("now"));
            $producto->setDisponible(true);
            $producto->setStock(0);

            $em->persist($producto);
            $em->flush();

            $status = "Producto registrado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("producto_index");
        }

        return $this->render('LavandaBundle:Productos:new.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function editAction(Request $request, $idproducto = null){
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $producto = $em->getRepository('LavandaBundle:Producto')->find($idproducto);
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $base = "uploads/productos/";
            $path = $base.$producto->getNombre()."/";

            if(!file_exists($path)){
                mkdir($path, 777, true);
            }

            $foto = $form["foto"]->getData();
            if(!empty($foto) && $foto != null){
                $ext = $foto->guessExtension();
                $file_name = time().".".$ext;
                $producto->setRutaimagen($path);
                $producto->setNombreimagen($file_name);
                $foto->move($path, $file_name);
            }

            $em->persist($producto);
            $em->flush();

            $status = "Producto editado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("producto_index");
        }

        return $this->render('LavandaBundle:Productos:edit.html.twig', array(
            "form"=>$form->createView(),
            "producto"=>$producto
        ));
    }

    public function listarProductosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('LavandaBundle:Producto')->findBy(array(
            "inventariocortesia" => false
        ));

        $arrProd = [];

        foreach ($productos as $producto){
            $arrProd[] = [
                "idproducto" => $producto->getIdproducto(),
                "nombre" => $producto->getNombre().", (Unidad de medida: ".$producto->getUnidadmedida()->getNombre(). ")"
            ];
        }

        return new JsonResponse($arrProd);
    }

    public function listarProductosCortesiasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('LavandaBundle:Producto')->findBy(array(
            "inventariocortesia" => true
        ));

        $arrProd = [];

        foreach ($productos as $producto){
            $arrProd[] = [
                "idproducto" => $producto->getIdproducto(),
                "nombre" => $producto->getNombre().", (Unidad de medida: ".$producto->getUnidadmedida()->getNombre(). ")"
            ];
        }

        return new JsonResponse($arrProd);
    }

}
