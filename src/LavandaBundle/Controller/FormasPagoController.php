<?php

namespace LavandaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class FormasPagoController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function listarFormasAction(){
        $em = $this->getDoctrine()->getManager();

        $formas = $em->getRepository('LavandaBundle:Formaspago')->findAll();

        $arrData = [];

        foreach ($formas as $forma){
            $arrData[] = [
                "idforma" => $forma->getIdformaspago(),
                "nombre" => $forma->getNombre()
            ];
        }

        return new JsonResponse($arrData);
    }
}
