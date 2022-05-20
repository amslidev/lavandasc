<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Cliente;
use LavandaBundle\Entity\Contacto;
use LavandaBundle\Entity\Usuario;
use LavandaBundle\Form\RegistroType;
use LavandaBundle\Form\ContactoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class AnonimoController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function contactoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $contacto = new Contacto();

        $form = $this->createForm(ContactoType::class, $contacto, [
            "action" => $this->generateUrl('arsc_contacto'),
            "method" => "POST"
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            try {
                $em->persist($contacto);
                $em->flush();

                $correo = $this->get('arsc.notificacion_correo_service');
                $correo->enviarMailContactoAnonimo($contacto);

                $status = "Gracias por ponerse en contacto con nosotros, uno de nuestros expertos se comunicará con usted a la brevedad.";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);

                return $this->redirectToRoute('login');
            }catch (\Exception $ex){
                $status = $ex->getMessage();
                $this->session->getFlashBag()->add("info","error");
                $this->session->getFlashBag()->add("status",$status);

                return $this->redirectToRoute('arsc_registro_anonimo');
            }
        }

        return $this->render('LavandaBundle:Anonimo:contacto.html.twig', array(
            "form" => $form->createView()
        ));
    }

    public function registroAction(Request  $request){
        $em = $this->getDoctrine()->getManager();

        $cliente = new Cliente();

        $form = $this->createForm(RegistroType::class, $cliente);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            try {
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
                return $this->redirectToRoute("login");
            }catch (\Exception $ex){
                $status = $ex->getMessage();
                $this->session->getFlashBag()->add("info","error");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("arsc_registro_anonimo");
            }
        }

        return $this->render('LavandaBundle:Anonimo:register.html.twig', array(
            "form" => $form->createView()
        ));
    }

    public function validarUsernameAnonimoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $username = $request->query->get('username');

        //var_dump($username);

        $usuario = $em->getRepository('LavandaBundle:Usuario')->findOneBy(array(
            "username"=>$username
        ));

        if(!is_object($usuario) && empty($usuario)){
            return new Response("",200);
        }else{
            return new Response("",500);
        }
    }

}
