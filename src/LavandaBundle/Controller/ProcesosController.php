<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Procesos;
use LavandaBundle\Form\ProcesosType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ProcesosController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function registrarProcesoAction(Request $request, $idcita = null){
        $em = $this->getDoctrine()->getManager();

        $cita = $em->getRepository('LavandaBundle:Citas')->find($idcita);

        $proceso = new Procesos();

        $form = $this->createForm(ProcesosType::class, $proceso);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $basedir = "uploads/procesos/".$cita->getIdcita();

                $path1 = $basedir."/fotoantes/";
                if(!file_exists($path1)){
                    mkdir($path1,777, true);
                }

                $path2 = $basedir."/fotodespues/";
                if(!file_exists($path2)){
                    mkdir($path2,777, true);
                }

                $file1 = $form["fotoantes"]->getData();
                if(!empty($file1) && $file1 != null){
                    $ext = $file1->guessExtension();
                    $file_name = $cita->getIdcita()."-FotoAntes".".".$ext;
                    $file1->move($path1, $file_name);
                    $proceso->setRutafotoantes($path1);
                    $proceso->setNombrefotoantes($file_name);
                }

                $file2 = $form["fotodespues"]->getData();
                if(!empty($file2) && $file2 != null){
                    $ext = $file2->guessExtension();
                    $file_name = $cita->getIdcita()."-FotoDespues".".".$ext;
                    $file2->move($path2, $file_name);
                    $proceso->setRutafotodesp($path2);
                    $proceso->setNombrefotodesp($file_name);
                }

                $proceso->setFechaproximacita($form->get('fechacita')->getData());
                $proceso->setIdcita($cita);

                $em->persist($proceso);
                $flush = $em->flush();

                if($flush == null){
                    $status = "Datos del proceso registados correctamente";
                    $this->session->getFlashBag()->add("info","success");

                }else{
                    $status = "Error al intentar registrar los datos del proceso";
                    $this->session->getFlashBag()->add("info","error");
                }
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("cliente_procesos", array("idcliente" => $cita->getIdcliente()->getIdcliente()));

            }
        }

        return $this->render('LavandaBundle:Procesos:registrar.html.twig', array(
            "cita" => $cita,
            "form" => $form->createView()
        ));
    }

    public function reporteProcesoAction($idcita){
        $em = $this->getDoctrine()->getManager();

        $proceso = $em->getRepository('LavandaBundle:Procesos')->findOneBy(array(
            "idcita" => $idcita
        ));

        return $this->render('LavandaBundle:Procesos:reporte.proceso.html.twig', array(
            "proceso" => $proceso
        ));
    }
}
