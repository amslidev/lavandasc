<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Proveedor;
use LavandaBundle\Form\ProveedorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ProveedoresController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(Request $request) : Response
    {
        $em = $this->getDoctrine()->getManager();

        $proveedores = $em->getRepository('LavandaBundle:Proveedor')->findAll();

        return $this->render('LavandaBundle:Proveedores:index.html.twig', [
            "proveedores" => $proveedores
        ]);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $proveedor = new Proveedor();

        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                try {
                    $em->persist($proveedor);
                    $em->flush();

                    $status = "Proveedor registrado correctamente";
                    $this->session->getFlashBag()->add("info","success");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("proveedores_index");
                }catch (\Exception $exception){
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info","error");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("proveedores_index");
                }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("proveedores_index");
            }
        }

        return $this->render('LavandaBundle:Proveedores:addproveedor.html.twig', [
            "form" => $form->createView()
        ]);
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $proveedor = $em->getRepository('LavandaBundle:Proveedor')->find($id);

        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                try {
                    $em->persist($proveedor);
                    $em->flush();

                    $status = "Proveedor editado correctamente";
                    $this->session->getFlashBag()->add("info","success");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("proveedores_index");
                }catch (\Exception $exception){
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info","error");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("proveedores_index");
                }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("proveedores_index");
            }
        }

        return $this->render('LavandaBundle:Proveedores:edit.html.twig', [
            "form" => $form->createView(),
            "proveedor" => $proveedor
        ]);
    }

}
