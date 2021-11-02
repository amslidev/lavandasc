<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Producto;
use LavandaBundle\Form\ProductoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('LavandaBundle:Producto')->findAll();

        return $this->render('LavandaBundle:Productos:index.html.twig', array(
            "productos"=>$productos
        ));
    }

    public function newAction(Request $request){
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

}
