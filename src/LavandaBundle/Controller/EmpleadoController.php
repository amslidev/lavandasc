<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Empleado;
use LavandaBundle\Form\EmpleadoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class EmpleadoController extends Controller
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

        $empleados = $em->getRepository('LavandaBundle:Empleado')->findAll();

        return $this->render('LavandaBundle:Empleados:index.html.twig', array(
            "empleados"=>$empleados
        ));
    }

    public function newAction(Request $request){
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $empleado = new Empleado();

        $form = $this->createForm(EmpleadoType::class, $empleado);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $form->get('activo')->getData() == null ? $empleado->setActivo(true) : $empleado->setActivo($form->get('activo')->getData());
            $empleado->setFecharegistro(new \DateTime("now"));

            $basedir = "uploads/empleados/";
            $path = $basedir.time()."/imagen/";
            if(!file_exists($path)){
                mkdir($path,777, true);
            }

            $file = $form["imagen"]->getData();
            if(!empty($file) && $file != null){
                $ext = $file->guessExtension();
                $file_name = $empleado->getNombre()."-".$empleado->getApellido().".".$ext;
                $file->move($path, $file_name);
                $empleado->setRutaimagen($path);
                $empleado->setNombreimagen($file_name);
            }

            $em->persist($empleado);
            $em->flush();

            $status = "Empleado registrado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("empleado_index");
        }

        return $this->render('LavandaBundle:Empleados:new.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function editAction(Request $request, $idempleado  = null){
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $empleado = $em->getRepository('LavandaBundle:Empleado')->find($idempleado);

        $form = $this->createForm(EmpleadoType::class, $empleado);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $basedir = "uploads/empleados/";
            $path = $basedir.time()."/imagen/";
            if(!file_exists($path)){
                mkdir($path,777, true);
            }

            $file = $form["imagen"]->getData();
            if(!empty($file) && $file != null){
                $ext = $file->guessExtension();
                $file_name = $empleado->getNombre()."-".$empleado->getApellido().".".$ext;
                $file->move($path, $file_name);
                $empleado->setRutaimagen($path);
                $empleado->setNombreimagen($file_name);
            }

            $em->persist($empleado);
            $em->flush();

            $status = "Empleado actualizado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("empleado_index");
        }

        return $this->render('LavandaBundle:Empleados:edit.html.twig', array(
            "form"=>$form->createView(),
            "empleado"=>$empleado
        ));
    }

    public function listarEmpleadosSucursalAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idsucursal = $request->get('idsucursal');

        $empleados = $em->getRepository('LavandaBundle:Empleado')->findBy(array(
            "idsucursal" => $idsucursal
        ));

        $arrEmpleados = array();

        foreach ($empleados as $empleado){
            $arrEmpleados[] = [
                "idempleado" => $empleado->getIdempleado(),
                "nombre" => $empleado->getNombre() . " " . $empleado->getApellido()
            ];
        }

        return new JsonResponse($arrEmpleados);
    }

}
