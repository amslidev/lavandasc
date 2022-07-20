<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Unidadesmedida;
use LavandaBundle\Form\UnidadesmedidaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UnidadesMedidaController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $unidades = $em->getRepository('LavandaBundle:Unidadesmedida')->findAll();

        return $this->render('LavandaBundle:UnidadesMedida:index.html.twig', [
            "unidades" => $unidades
        ]);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $unidad = new Unidadesmedida();

        $form = $this->createForm(UnidadesmedidaType::class, $unidad);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                try {
                    $em->persist($unidad);
                    $em->flush();

                    $status = "Unidad de medida registrada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("unidadesmedida_index");
                }catch (\Exception $exception){
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info","error");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("unidadesmedida_index");
                }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("unidadesmedida_new");
            }
        }

        return $this->render('LavandaBundle:UnidadesMedida:add.html.twig', [
            "form" => $form->createView()
        ]);
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $unidad = $em->getRepository('LavandaBundle:Unidadesmedida')->find($id);

        $form = $this->createForm(UnidadesmedidaType::class, $unidad);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                try {
                    $em->persist($unidad);
                    $em->flush();

                    $status = "Unidad de medida editada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("unidadesmedida_index");
                }catch (\Exception $exception){
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info","error");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("unidadesmedida_index");
                }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("unidadesmedida_edit", ["id" => $id]);
            }
        }

        return $this->render('LavandaBundle:UnidadesMedida:edit.html.twig', [
            "form" => $form->createView(),
            "unidad" => $unidad
        ]);
    }

}
