<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Sucursal;
use LavandaBundle\Form\SucursalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
                try {
                    $clave = $form->get('clave')->getData();
                    $sucursal->setClave(strtoupper($clave));

                    $em->persist($sucursal);

                    $flush = $em->flush();

                    $status = "Sucursal registrada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                }catch (\Exception $e){
                    $status = "Error al intentar registrar la sucursal";
                    $this->session->getFlashBag()->add("info","error");
                }
            }else{
                $status = "Error al intentar registrar la sucursal, algunos datos no son válidos";
                $this->session->getFlashBag()->add("info","error");
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("sucursal_index");
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
                try {
                    $clave = $form->get('clave')->getData();
                    $sucursal->setClave(strtoupper($clave));

                    $em->persist($sucursal);

                    $flush = $em->flush();

                    $status = "Sucursal editada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                }catch (\Exception $e){
                    $status = "Error al intentar editar la sucursal";
                    $this->session->getFlashBag()->add("info","error");
                }
            }else{
                $status = "Error al intentar editar la sucursal, algunos datos no son válidos";
                $this->session->getFlashBag()->add("info","error");
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("sucursal_index");
        }

        return $this->render('LavandaBundle:Sucursales:new.html.twig', array(
            "form" => $form->createView()
        ));
    }

    public function listarSucursalesPOSAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sucursales = $em->getRepository('LavandaBundle:Sucursal')->findBy([
            "activo" => 1
        ]);

        $arrSucursales = [];

        foreach ($sucursales as $sucursal){
            $arrSucursales[] = [
                "idsucursal" => $sucursal->getIdsucursal(),
                "nombre" => $sucursal->getNombre()
            ];
        }

        return new JsonResponse($arrSucursales);
    }
}
