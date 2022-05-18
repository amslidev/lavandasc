<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Expedientecliente;
use LavandaBundle\Form\ExpedienteclienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ExpedienteController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(Request $request, $idcliente = null){
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

        $expediente = $em->getRepository('LavandaBundle:Expedientecliente')->findOneBy(array(
            "idcliente" => $cliente->getIdcliente()
        ));

        if($expediente == null){
            $expediente = new Expedientecliente();
        }

        $form = $this->createForm(ExpedienteclienteType::class, $expediente);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $expediente->setIdcliente($cliente);

                $em->persist($expediente);

                $flush = $em->flush();

                if($flush == null){
                    $status = "Información guardada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                }else{
                    $status = "Error al intentar guardar la información";
                    $this->session->getFlashBag()->add("info","error");
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("cliente_expediente", array("idcliente" => $cliente->getIdcliente()));
            }
        }

        return $this->render('LavandaBundle:Clientes:expediente.html.twig', array(
            "cliente" => $cliente,
            "form" => $form->createView()
        ));

    }

}
