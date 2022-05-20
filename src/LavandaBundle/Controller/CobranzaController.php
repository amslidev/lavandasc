<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Cobranza;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class CobranzaController extends Controller
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

        $query = $em->createQuery(
            "SELECT c FROM LavandaBundle:Citas c 
            LEFT JOIN LavandaBundle:Estatuscita e WITH c.idestatus = e.idestatus 
            WHERE e.clave = 'EC4'"
        );

        $citas = $query->getResult();

        return $this->render('LavandaBundle:Citas:cobranzal.html.twig', array(
            "citas" => $citas
        ));
    }

    public function cobrarServicioAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idcita = $request->get('idcita');

        $response = new Response();

        if($idcita != ""){
            $cita = $em->getRepository('LavandaBundle:Citas')->find($idcita);
            $servicio = $em->getRepository('LavandaBundle:Servicio')->findOneBy(array(
                "idservicio" => $cita->getIdservicio()->getIdservicio()
            ));

            $estatus = $em->getRepository('LavandaBundle:Estatuscita')->findOneBy(array(
                "clave" => "EC5"
            ));

            $cita->setIdestatus($estatus);

            $user = $this->getUser();

            $cobranza = new Cobranza();
            $cobranza->setIdcita($cita);
            $cobranza->setCantidadonza(0);
            $cobranza->setTotal($servicio->getPrecio());
            $cobranza->setFecharegistro(new \DateTime("now"));
            $cobranza->setIdusuario($user);

            $em->persist($cobranza);
            $em->persist($cita);

            $flush = $em->flush();

            if($flush == null){
                $response->setStatusCode(200);
            }else{
                $response->setStatusCode(500);
            }

        }else{
            $response->setStatusCode(500);
        }
        return $response;
    }

    public function cobrarOnzaAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idcita = $request->get('idcita');
        $cantidadOnza = $request->get('onzas');
        $total = $request->get('total');

        $response = new Response();

        if($idcita != ""){
            $cita = $em->getRepository('LavandaBundle:Citas')->find($idcita);
            $servicio = $em->getRepository('LavandaBundle:Servicio')->findOneBy(array(
                "idservicio" => $cita->getIdservicio()->getIdservicio()
            ));

            $estatus = $em->getRepository('LavandaBundle:Estatuscita')->findOneBy(array(
                "clave" => "EC5"
            ));

            $cita->setIdestatus($estatus);

            $user = $this->getUser();


            $cobranza = new Cobranza();
            $cobranza->setIdcita($cita);
            //$cobranza->setCantidadonza($cantidadOnza);
            $cobranza->setTotal($total);
            $cobranza->setFecharegistro(new \DateTime("now"));
            $cobranza->setIdusuario($user);

            $em->persist($cobranza);
            $em->persist($cita);

            $flush = $em->flush();

            if($flush == null){
                $response->setStatusCode(200);
            }else{
                $response->setStatusCode(500);
            }

        }else{
            $response->setStatusCode(500);
        }
        return $response;

    }
}
