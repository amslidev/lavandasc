<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Cortesias;
use LavandaBundle\Form\CortesiasType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CortesiasController extends Controller
{
     private $session;

     public function __construct()
     {
         $this->session = new Session();
     }

     public function indexAction(){
         $em = $this->getDoctrine()->getManager();

         $cortesias = $em->getRepository('LavandaBundle:Cortesias')->findAll();

         return $this->render('LavandaBundle:Cortesias:index.html.twig', array(
             "cortesias"=>$cortesias
         ));
     }

     public function newAction(Request $request){
         //Accedemos al Entity Manager de Doctrine
         $em = $this->getDoctrine()->getManager();

         //Creamos una nueva instancia de cortesía
         $cortesia = new Cortesias();
         //Creamos el formulario y le pasamos como parámetro nuestra instancia de cortesía
         $form = $this->createForm(CortesiasType::class, $cortesia);

         $form->handleRequest($request);

         //Validamos que el formulario haya sido enviado y sea válido
         if($form->isSubmitted() && $form->isValid()){
            $cortesia->setDisponible(true);
            $cortesia->setFechaingreso(new \DateTime("now"));

            //Creamos la ruta para la foto
            $base = "uploads/cortesias";
            $path = $base."/".$cortesia->getNombre()."/";

            //Verificamos que exista la ruta y si no existe, la creamos
            if(!file_exists($path)){
                mkdir($path,777,true);
            }

            //recuperamos el archivo enviado y lo guardamos en una variable de nombre foto
            $foto = $form["foto"]->getData();
            //Validamos que nos hayan enviado un archivo
            if(!empty($foto) && $foto != null){
                //Recuperamos la extensión del archivo
                $ext = $foto->guessExtension();
                //Asignamos el nuevo nombre del archivo
                $file_name = time().".".$ext;
                //Asignamos la ruta y el nombre del archivo a los atributos de nuestra entidad Cortesía
                $cortesia->setRutaimagen($path);
                $cortesia->setNombreimagen($file_name);
                //Movemos el archivo de la carpeta temp a la nueva ruta
                $foto->move($path, $file_name);
            }

            //Guardamos la información
            $em->persist($cortesia);
            //Escribir los cambios
            $em->flush();


            $status = "Cortesía registrada correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("cortesia_index");
         }

         return $this->render('LavandaBundle:Cortesias:new.html.twig', array(
             "form"=>$form->createView()
         ));
     }

     public function editAction(Request $request, $idcortesia = null){
         $em = $this->getDoctrine()->getManager();

         $cortesia = $em->getRepository('LavandaBundle:Cortesias')->find($idcortesia);

         $form = $this->createForm(CortesiasType::class, $cortesia);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
             $base = "uploads/cortesias";
             $path = $base."/".$cortesia->getNombre()."/";

             if(!file_exists($path)){
                 mkdir($path,777,true);
             }

             $foto = $form["foto"]->getData();
             if(!empty($foto) && $foto != null){
                 $ext = $foto->guessExtension();
                 $file_name = time().".".$ext;
                 $cortesia->setRutaimagen($path);
                 $cortesia->setNombreimagen($file_name);
                 $foto->move($path, $file_name);
             }

             $em->persist($cortesia);
             $em->flush();

             $status = "Cortesía editada correctamente";
             $this->session->getFlashBag()->add("info","success");
             $this->session->getFlashBag()->add("status",$status);
             return $this->redirectToRoute("cortesia_index");
         }


         return $this->render('LavandaBundle:Cortesias:edit.html.twig', array(
             "form"=>$form->createView(),
             "cortesia"=>$cortesia
         ));
     }
}
