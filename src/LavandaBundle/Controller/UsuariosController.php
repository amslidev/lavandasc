<?php
/**
 * Created by PhpStorm.
 * User: LEN0V0
 * Date: 10/06/2021
 * Time: 08:41 PM
 */

namespace LavandaBundle\Controller;


use LavandaBundle\Entity\Usuario;
use LavandaBundle\Form\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;

class UsuariosController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function loginAction(Request $request){
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render("LavandaBundle:Usuarios:login.html.twig", array(
            "error" => $error,
            "last_Username" => $lastUsername
        ));

    }

    public function supportAction(){
        $publicResourcesFolderPath = "../web/uploads/manuales/";
        $filename = "manual.pdf";

        $response = new BinaryFileResponse($publicResourcesFolderPath.$filename);

        $mimeTypeGuesser = new FileinfoMimeTypeGuesser();

        // Set the mimetype with the guesser or manually
        if($mimeTypeGuesser->isSupported()){
            // Guess the mimetype of the file according to the extension of the file
            $response->headers->set('Content-Type', $mimeTypeGuesser->guess($publicResourcesFolderPath.$filename));
        }else{
            // Set the mimetype of the file manually, in this case for a text file is text/plain
            $response->headers->set('Content-Type', 'application/pdf');
        }

        // Set content disposition inline of the file
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );

        return $response;
    }

    public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('LavandaBundle:Usuario')->findAll();

        return $this->render('LavandaBundle:Usuarios:index.html.twig', array(
            "usuarios" => $usuarios
        ));
    }

    public function registrarUsuarioAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($usuario);
            $password = $encoder->encodePassword($form->get('password')->getData(), $usuario->getSalt());
            $usuario->setPassword($password);

            $usuario->setCreatedAt(new \DateTime("now"));
            $usuario->setIsactive(true);

            $base = "uploads/usuarios";
            $path = $base."/".$usuario->getUsername()."/";

            if(!file_exists($path)){
                mkdir($path,'777', true);
            }

            $foto = $form["foto"]->getData();
            if(!empty($foto) && $foto != null){
                $ext = $foto->guessExtension();
                $file_name = time().".".$ext;
                $usuario->setRutaimagen($path);
                $usuario->setNombreimagen($file_name);
                $foto->move($path, $file_name);
            }

            $em->persist($usuario);
            $em->flush();

            $status = "Usuario registrado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("users_index");
        }

        return $this->render('LavandaBundle:Usuarios:registrar.usuario.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function validarUsernameAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $username = $request->query->get('username');

        var_dump($username);

        $usuario = $em->getRepository('LavandaBundle:Usuario')->findOneBy(array(
           "username"=>$username
        ));

        if(!is_object($usuario) && empty($usuario)){
            return new Response("",200);
        }else{
            return new Response("",500);
        }
    }

    public function editarUsuarioAction(Request $request, $idusuario = null){
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository('LavandaBundle:Usuario')->find($idusuario);
        $form = $this->createForm(UsuarioType::class, $usuario);
        //$form->remove('username');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!empty($form->get('password')->getData()) && $form->get('password')->getData() != null){
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($usuario);
                $password = $encoder->encodePassword($form->get('password')->getData(), $usuario->getSalt());
                $usuario->setPassword($password);
            }


            $base = "uploads/usuarios";
            $path = $base."/".$usuario->getUsername()."/";

            if(!file_exists($path)){
                mkdir($path,'777', true);
            }

            $foto = $form["foto"]->getData();
            if(!empty($foto) && $foto != null){
                $ext = $foto->guessExtension();
                $file_name = time().".".$ext;
                $usuario->setRutaimagen($path);
                $usuario->setNombreimagen($file_name);
                $foto->move($path, $file_name);
            }

            $em->persist($usuario);
            $em->flush();

            $status = "Usuario editado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("users_index");
        }

        return $this->render('LavandaBundle:Usuarios:editar.usuario.html.twig', array(
            "form"=>$form->createView(),
            "usuario"=>$usuario
        ));
    }

    public  function  lockUserAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idusuario = $request->query->get('idusuario');

        $usuario = $em->getRepository('LavandaBundle:Usuario')->find($idusuario);

        $usuario->setIsactive(false);

        $em->persist($usuario);
        $flush = $em->flush();

        $response = new Response();
        if($flush == null){
            $response->setStatusCode(200);
        }else{
            $response->setStatusCode(500);
        }
        return $response;
    }

    public  function  unlockUserAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idusuario = $request->query->get('idusuario');

        $usuario = $em->getRepository('LavandaBundle:Usuario')->find($idusuario);

        $usuario->setIsactive(true);

        $em->persist($usuario);
        $flush = $em->flush();

        $response = new Response();
        if($flush == null){
            $response->setStatusCode(200);
        }else{
            $response->setStatusCode(500);
        }
        return $response;
    }
}