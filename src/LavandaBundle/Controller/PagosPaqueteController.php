<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Pagospaquetes;
use LavandaBundle\Form\PagospaquetesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class PagosPaqueteController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(Request $request, $idpaquete){
        $em = $this->getDoctrine()->getManager();

        $paquete = $em->getRepository('LavandaBundle:Paquetes')->find($idpaquete);

        $pagos = $em->getRepository('LavandaBundle:Pagospaquetes')->findBy([
            "idpaquete" => $paquete->getIdpaquete()
        ]);

        $sumaPagos = 0;

        foreach ($pagos as $pago){
            $sumaPagos = $sumaPagos + $pago->getCantidadabonada();
        }

        $pagospaquete = new Pagospaquetes();

        $pagoPendiente = $paquete->getPrecio() - $sumaPagos;

        $form = $this->createForm(PagospaquetesType::class, $pagospaquete);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $pagospaquete->setIdpaquete($paquete);
                $pagospaquete->setFechapago(new \DateTime("now"));
                $em->persist($pagospaquete);
                $em->flush();

                $status = "Pago registrado correctamente";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);

                return $this->redirectToRoute('pagospaquetes_index', ["idpaquete"=>$paquete->getIdpaquete()]);
            }
        }

        return $this->render('LavandaBundle:Pagospaquetes:index.html.twig', [
            "paquete" => $paquete,
            "pagos" => $pagos,
            "sumapagos" => $sumaPagos,
            "pagopendiente" => $pagoPendiente,
            "form" => $form->createView()
        ]);
    }

    public function editAction(Request $request, $idpagopaquete){
        $em = $this->getDoctrine()->getManager();

        $pagopaquete = $em->getRepository('LavandaBundle:Pagospaquetes')->find($idpagopaquete);

        $form = $this->createForm(PagospaquetesType::class, $pagopaquete);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $em->persist($pagopaquete);
                $em->flush();

                $status = "Pago editado correctamente";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);

                return $this->redirectToRoute('pagospaquetes_index', ["idpaquete"=>$pagopaquete->getIdpaquete()->getIdpaquete()]);
            }
        }

        return $this->render('LavandaBundle:Pagospaquetes:edit.html.twig', [
            "form" => $form->createView(),
            "pagopaquete" => $pagopaquete
        ]);
    }

    public function deleteAction($idpagopaquete){
        $em = $this->getDoctrine()->getManager();

        $pagopaquete = $em->getRepository('LavandaBundle:Pagospaquetes')->find($idpagopaquete);

        if($pagopaquete){

            $evento = "Se eliminó el registro de pago con cantidad ".$pagopaquete->getCantidadabonada();
            $em->remove($pagopaquete);
            $em->flush();

            $user = $this->getUser();



            $log = $this->get('arsc.logs_service');
            $log->registrarLog($user->getIdusuario(), "PagosPaquetes->Eliminar()", $evento);


            $status = "Pago eliminado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute('pagospaquetes_index', ["idpaquete"=> $pagopaquete->getIdpaquete()->getIdpaquete()]);

        }else{
            $status = "No se encontró información del pago";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute('paquetes_index');
        }

    }
}
