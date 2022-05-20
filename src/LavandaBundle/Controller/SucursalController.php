<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Sucursal;
use LavandaBundle\Form\SucursalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SucursalController extends Controller
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

        $sucursales = $em->getRepository('LavandaBundle:Sucursal')->findAll();

        return $this->render('LavandaBundle:Sucursales:index.html.twig', array(
            "sucursales" => $sucursales
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

        $sucursal = new Sucursal();

        $form = $this->createForm(SucursalType::class, $sucursal);
        $form->handleRequest($request);

        $form->get('activo')->isRequired();

        if($form->isSubmitted()){
            if($form->isValid()){

                $em->persist($sucursal);

                $flush = $em->flush();

                if($flush == null){
                    $status = "Sucursal registrada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                }else{
                    $status = "Error al intentar registrar la Sucursal";
                    $this->session->getFlashBag()->add("info","error");
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("sucursal_index");

            }
        }

        return $this->render('LavandaBundle:Sucursales:new.html.twig', array(
            "form" => $form->createView()
        ));
    }

    public function editAction(Request $request, $id){
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $sucursal = $em->getRepository('LavandaBundle:Sucursal')->find($id);

        $form = $this->createForm(SucursalType::class, $sucursal);
        $form->handleRequest($request);


        if($form->isSubmitted()){
            if($form->isValid()){

                $em->persist($sucursal);

                $flush = $em->flush();

                if($flush == null){
                    $status = "Sucursal editada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                }else{
                    $status = "Error al intentar editar la Sucursal";
                    $this->session->getFlashBag()->add("info","error");
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("sucursal_index");

            }
        }

        return $this->render('LavandaBundle:Sucursales:new.html.twig', array(
            "form" => $form->createView()
        ));
    }
}
