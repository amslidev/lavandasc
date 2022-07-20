<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Bodegas;
use LavandaBundle\Form\BodegasType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class BodegaController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction($id = null){
        $em = $this->getDoctrine()->getManager();

        if($id != null){
            $bodegas = $em->getRepository('LavandaBundle:Bodegas')->find($id);
        }else{
            $bodegas = $em->getRepository('LavandaBundle:Bodegas')->findAll();
        }

        return $this->render('LavandaBundle:Bodegas:index.html.twig', [
            "bodegas" => $bodegas
        ]);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $bodega = new Bodegas();

        $form = $this->createForm(BodegasType::class, $bodega);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                try {
                    $em->persist($bodega);
                    $em->flush();

                    $status = "Bodega registrada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("bodegas_index");
                }catch (\Exception $exception){
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info","error");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("bodegas_index");
                }
            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("bodegas_index");
            }
        }

        return $this->render('LavandaBundle:Bodegas:add.html.twig', [
            "form" => $form->createView()
        ]);
    }

    public function editAction(Request  $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $bodega = $em->getRepository('LavandaBundle:Bodegas')->find($id);

        $form = $this->createForm(BodegasType::class, $bodega);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    $em->persist($bodega);
                    $em->flush();

                    $status = "Bodega editada correctamente";
                    $this->session->getFlashBag()->add("info", "success");
                    $this->session->getFlashBag()->add("status", $status);
                    return $this->redirectToRoute("bodegas_index");
                } catch (\Exception $exception) {
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info", "error");
                    $this->session->getFlashBag()->add("status", $status);
                    return $this->redirectToRoute("bodegas_index");
                }
            } else {
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info", "success");
                $this->session->getFlashBag()->add("status", $status);
                return $this->redirectToRoute("bodegas_edit", array("id" => $id));
            }
        }

        return $this->render('LavandaBundle:Bodegas:edit.html.twig', [
            "form" => $form->createView(),
            "bodega" => $bodega
        ]);
    }
}
