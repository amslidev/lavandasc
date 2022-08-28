<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Paquetes;
use LavandaBundle\Form\PaquetesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class PaquetesController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $paquetes = $em->getRepository('LavandaBundle:Paquetes')->findAll();

        return $this->render('LavandaBundle:Paquetes:index.html.twig', [
            "paquetes" => $paquetes
        ]);
    }

    public function newAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $paquete = new Paquetes();

        $form = $this->createForm('LavandaBundle\Form\PaquetesType', $paquete);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $paquete->setFechainicio(new \DateTime("now"));
                $em->persist($paquete);
                $em->flush();

                $status = "Paquete registrado correctamente";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);

                return $this->redirectToRoute('paquetes_index');
            }
        }

        return $this->render('LavandaBundle:Paquetes:new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    public function editAction(Request $request, $idpaquete){
        $em = $this->getDoctrine()->getManager();

        $paquete = $em->getRepository('LavandaBundle:Paquetes')->find($idpaquete);

        $form = $this->createForm(PaquetesType::class, $paquete);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $em->persist($paquete);
                $em->flush();

                $status = "Paquete editado correctamente";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);

                return $this->redirectToRoute('paquetes_index');
            }
        }

        return $this->render('LavandaBundle:Paquetes:edit.html.twig', [
            "form" => $form->createView(),
            "paquete" => $paquete
        ]);
    }

}
