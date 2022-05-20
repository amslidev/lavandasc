<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Cliente;
use LavandaBundle\Entity\Usuario;
use LavandaBundle\Form\ClienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    public function addAction(Request $request){
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $cliente = new Cliente();

        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
                $usuario = new Usuario();

                $usuario->setUsername($form->get('username')->getData());
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($usuario);
                $password = $encoder->encodePassword($form->get('password')->getData(), $usuario->getSalt());
                $usuario->setPassword($password);
                $usuario->setRole('ROLE_CLIENTE');

                $usuario->setCreatedAt(new \DateTime("now"));
                $usuario->setIsactive(true);

                $em->persist($usuario);
                $cliente->setIdusuario($usuario);
                $em->persist($cliente);
                $em->flush();

                $this->get('arsc.notificacion_correo_service')->enviarCorreoRegistro($cliente, $form->get('username')->getData(), $form->get('password')->getData());

                $status = "Cliente registrado correctamente, pronto le llegará un correo con sus datos de usuario";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("clientes_index");
        }

        return $this->render('LavandaBundle:Clientes:add.html.twig', array(
            "form" => $form->createView()
        ));
    }

    public function editAction(Request $request, $idcliente = null){
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

        $user = $this->getUser();

        $role = $user->getRole();

        $form = $this->createForm(ClienteType::class, $cliente);

        $form->remove('username');
        $form->remove('password');

        if($role == "ROLE_USER"){
            $form->remove('telefono');
        }

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

    public function paginaContactoAction(Request  $request){

    }
}
