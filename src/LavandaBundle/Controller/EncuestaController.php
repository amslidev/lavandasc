<?php

namespace LavandaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EncuestaController extends Controller
{
    public function verEncuestaAction($idcliente){
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

        $encuesta = $em->getRepository('LavandaBundle:Encuesta')->findOneBy(array(
            "idcliente"=>$idcliente
        ));

        return $this->render('LavandaBundle:Encuesta:ver.encuesta.html.twig', array(
            "cliente"=>$cliente,
            "encuesta"=>$encuesta
        ));
    }
}
