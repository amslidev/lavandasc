<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Form\ClienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class ClientesController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction($idcliente = null){
        $em = $this->getDoctrine()->getManager();

        if($idcliente != null){
            $clientes = $em->getRepository('LavandaBundle:Cliente')->findBy(array(
                "idcliente" => $idcliente
            ));
        }else{
            $clientes = $em->getRepository('LavandaBundle:Cliente')->findAll();
        }

        return $this->render('LavandaBundle:Clientes:index.html.twig', array(
            "clientes"=>$clientes
        ));
    }

    public function editAction(Request $request, $idcliente = null){
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em->persist($cliente);

                $flush = $em->flush();

                if($flush == null){
                    $status = "Cliente editado correctamente";
                    $this->session->getFlashBag()->add("info","success");
                }else{
                    $status = "Error al intentar editar al cliente";
                    $this->session->getFlashBag()->add("info","error");
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("clientes_index");

            }
        }

        return $this->render('LavandaBundle:Clientes:edit.html.twig', array(
            "form" => $form->createView(),
            "cliente" => $cliente
        ));
    }

    public function validaEmailAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idcliente = $request->query->get('idcliente');
        $email = $request->query->get('email');

        $query = $em->createQuery(
            "SELECT c FROM LavandaBundle:Cliente c 
            WHERE c.email = :email 
            AND c.idcliente <> :idcliente"
        );

        $query->setParameter("idcliente", $idcliente);
        $query->setParameter("email", $email);

        $cliente = $query->getOneOrNullResult();

        $response = new Response();

        if($cliente == null){
            $response->setStatusCode(200);
        }else{
            $response->setStatusCode(500);
        }

        return $response;
    }
}
