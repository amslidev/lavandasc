<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Categorias;
use LavandaBundle\Form\CategoriasType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CategoriasController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('LavandaBundle:Categorias')->findAll();

        return $this->render('LavandaBundle:Categorias:index.html.twig', [
            "categorias" => $categorias
        ]);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categoria = new Categorias();

        $form = $this->createForm(CategoriasType::class, $categoria);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                try {
                    $em->persist($categoria);
                    $em->flush();

                    $status = "Categoría registrada correctamente";
                    $this->session->getFlashBag()->add("info", "success");
                    $this->session->getFlashBag()->add("status", $status);
                    return $this->redirectToRoute("categorias_index");
                } catch (\Exception $exception) {
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info", "error");
                    $this->session->getFlashBag()->add("status", $status);
                    return $this->redirectToRoute("categorias_index");
                }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("categorias_index");
            }
        }

        return $this->render('LavandaBundle:Categorias:add.html.twig', [
            "form" => $form->createView()
        ]);
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('LavandaBundle:Categorias')->find($id);

        $form = $this->createForm(CategoriasType::class, $categoria);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                try {
                    $em->persist($categoria);
                    $em->flush();

                    $status = "Categoría editada correctamente";
                    $this->session->getFlashBag()->add("info", "success");
                    $this->session->getFlashBag()->add("status", $status);
                    return $this->redirectToRoute("categorias_index");
                } catch (\Exception $exception) {
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info", "error");
                    $this->session->getFlashBag()->add("status", $status);
                    return $this->redirectToRoute("categorias_index");
                }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("categorias_index");
            }
        }

        return $this->render('LavandaBundle:Categorias:edit.html.twig', [
            "form" => $form->createView(),
            "categoria" => $categoria
        ]);
    }

}
