<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Servicio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Servicio controller.
 *
 */
class ServicioController extends Controller
{
    /**
     * Lists all servicio entities.
     *
     */

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $em = $this->getDoctrine()->getManager();

        $servicios = $em->getRepository('LavandaBundle:Servicio')->findAll();

        return $this->render('LavandaBundle:servicio:index.html.twig', array(
            'servicios' => $servicios,
        ));
    }

    /**
     * Creates a new servicio entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $servicio = new Servicio();
        $form = $this->createForm('LavandaBundle\Form\ServicioType', $servicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $base = "uploads/servicios/";
            $path = $base.$servicio->getNombre()."/";

            if(!file_exists($path)){
                mkdir($path, 777, true);
            }

            $foto = $form["file"]->getData();
            if(!empty($foto) && $foto != null){
                $ext = $foto->guessExtension();
                $file_name = time().".".$ext;
                $servicio->setRutaimagen($path);
                $servicio->setNombreimagen($file_name);
                $foto->move($path, $file_name);
            }

            //Validar el está selecciona la opción de predeterminado
            $default = $form->get('predeterminado')->getData();
            if($default){
                $servicioDefault = $em->getRepository('LavandaBundle:Servicio')->findOneBy([
                    "predeterminado" => true
                ]);

                if($servicioDefault != null){
                    $servicioDefault->setPredeterminado(false);
                    $em->persist($servicioDefault);
                    $servicio->setPredeterminado(true);
                }else{
                    $servicio->setPredeterminado(true);
                }
            }


            $em->persist($servicio);
            $em->flush();

            $status = "Servicio registrado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);

            return $this->redirectToRoute('servicio_index');
        }

        return $this->render('LavandaBundle:servicio:new.html.twig', array(
            'servicio' => $servicio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a servicio entity.
     *
     */
    public function showAction(Servicio $servicio)
    {
        $deleteForm = $this->createDeleteForm($servicio);

        return $this->render('LavandaBundle:servicio:show.html.twig', array(
            'servicio' => $servicio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing servicio entity.
     *
     */
    public function editAction(Request $request, Servicio $servicio)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $deleteForm = $this->createDeleteForm($servicio);
        $editForm = $this->createForm('LavandaBundle\Form\ServicioType', $servicio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $base = "uploads/servicios/";
            $path = $base.$servicio->getNombre()."/";

            if(!file_exists($path)){
                mkdir($path, 777, true);
            }

            $foto = $editForm["file"]->getData();
            if(!empty($foto) && $foto != null){
                $ext = $foto->guessExtension();
                $file_name = time().".".$ext;
                $servicio->setRutaimagen($path);
                $servicio->setNombreimagen($file_name);
                $foto->move($path, $file_name);
            }

            //Validar el está selecciona la opción de predeterminado
            $default = $editForm->get('predeterminado')->getData();
            if($default){
                $servicioDefault = $em->getRepository('LavandaBundle:Servicio')->findOneBy([
                    "predeterminado" => 1
                ]);

                if($servicioDefault != null){
                    $servicioDefault->setPredeterminado(false);
                    $em->persist($servicioDefault);
                    $servicio->setPredeterminado(true);
                }else{
                    $servicio->setPredeterminado(true);
                }
            }

            $em->persist($servicio);
            $em->flush();

            $status = "Servicio editado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);

            return $this->redirectToRoute('servicio_index');
        }

        return $this->render('LavandaBundle:servicio:edit.html.twig', array(
            'servicio' => $servicio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a servicio entity.
     *
     */
    public function deleteAction(Request $request, Servicio $servicio)
    {
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN"){
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }else if($user->getRole() == "ROLE_USER"){
            $this->denyAccessUnlessGranted('ROLE_USER', $user, 'No tiene acceso a esta página');
        }else{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', $user, 'No tiene acceso a esta página');
        }
        $form = $this->createDeleteForm($servicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servicio);
            $em->flush();
        }

        return $this->redirectToRoute('servicio_index');
    }

    /**
     * Creates a form to delete a servicio entity.
     *
     * @param Servicio $servicio The servicio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Servicio $servicio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicio_delete', array('idservicio' => $servicio->getIdservicio())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function listarServiciosAjaxAction(){
        $em = $this->getDoctrine()->getManager();

        $servicios = $em->getRepository('LavandaBundle:Servicio')->findAll();

        $arrServicios = [];

        foreach ($servicios as $servicio){
            $arrServicios[] = [
                "idservicio" => $servicio->getIdservicio(),
                "nombre" => $servicio->getNombre()
            ];
        }

        return new JsonResponse($arrServicios);
    }
}
