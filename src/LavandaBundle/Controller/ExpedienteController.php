<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Expediente;
use LavandaBundle\Entity\Expedientecliente;
use LavandaBundle\Form\ExpedienteclienteType;
use LavandaBundle\Form\ExpedienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ExpedienteController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    /*public function indexAction(Request $request, $idcliente = null){
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

        $expediente = $em->getRepository('LavandaBundle:Expedientecliente')->findOneBy(array(
            "idcliente" => $cliente->getIdcliente()
        ));

        if($expediente == null){
            $expediente = new Expedientecliente();
        }

        $form = $this->createForm(ExpedienteclienteType::class, $expediente);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $expediente->setIdcliente($cliente);

                $em->persist($expediente);

                $flush = $em->flush();

                if($flush == null){
                    $status = "Información guardada correctamente";
                    $this->session->getFlashBag()->add("info","success");
                }else{
                    $status = "Error al intentar guardar la información";
                    $this->session->getFlashBag()->add("info","error");
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("cliente_expediente", array("idcliente" => $cliente->getIdcliente()));
            }
        }

        return $this->render('LavandaBundle:Clientes:expediente-antiguo.html.twig', array(
            "cliente" => $cliente,
            "form" => $form->createView()
        ));

    }*/

    public function addExpedienteClienteAction(Request  $request, $idcliente){
        $em = $this->getDoctrine()->getManager();

        $fotos = $em->getRepository('LavandaBundle:Expediente')->findBy(array(
            "idcliente" => $idcliente
        ));

        $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

        $form = $this->createForm(ExpedienteType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(isset($form["files"])){
                $basedir = "uploads/clientes/".$idcliente."/expediente/";

                if(!file_exists($basedir)){
                    mkdir($basedir, 777, true);
                }

                $files = $form["files"]->getData();

                $count = 0;
                $countErrores = 0;
                foreach ($files as $key => $value){
                    $ext = $value->guessExtension();
                    if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {

                        //comprimir la imagen
                        $imgInfo = getimagesize($value);
                        $mime = $imgInfo['mime'];

                        switch ($mime) {
                            case 'image/jpeg':
                                $image = imagecreatefromjpeg($value);
                                break;
                            case 'image/jpg':
                                $image = imagecreatefromjpeg($value);
                                break;
                            case 'image/png':
                                $image = imagecreatefrompng($value);
                                break;
                            default:
                                $image = imagecreatefromjpeg($value);
                        }

                        $file_name = "Foto-" . $count . time() . "." . $ext;
                        $expediente = new Expediente();
                        $expediente->setIdcliente($cliente);
                        $expediente->setRutafoto($basedir);
                        $expediente->setNombrefoto($file_name);
                        $expediente->setFecha(new \DateTime("now"));

                        imagejpeg($image, $basedir.$file_name, 60);
                        $em->persist($expediente);
                        $flush = $em->flush();
                        if ($flush != null) {
                            $countErrores++;
                        }
                    }else{
                        $countErrores++;
                    }
                    $count++;
                }
            }else{
                $status = "No se seleccionaron imágenes";
                $this->session->getFlashBag()->add("info", "error");
                return $this->redirectToRoute('cliente_expediente', array("idcliente" => $cliente->getIdcliente()));
            }
            if($countErrores != 0){
                $status = "Uno o varios archivos presentaron errores cuando se intentaban subirlos al sistema";
                $this->session->getFlashBag()->add("info", "info");
            }else{
                $status = "Todos los archivos fueron cargados correctamente";
                $this->session->getFlashBag()->add("info", "success");
            }
            return $this->redirectToRoute('cliente_expediente', array("idcliente" => $cliente->getIdcliente()));
        }

        return $this->render('LavandaBundle:Clientes:expediente.html.twig', array(
            "form" => $form->createView(),
            "cliente" => $cliente,
            "fotos" => $fotos
        ));
    }

    public function elimarFotoAction($idfoto = null){
        $em = $this->getDoctrine()->getManager();

        $foto = $em->getRepository('LavandaBundle:Expediente')->find($idfoto);
        $idcliente = $foto->getIdcliente()->getIdcliente();
        $ruta = $foto->getRutafoto().$foto->getNombrefoto();

        unlink($ruta);

        $em->remove($foto);
        $flush = $em->flush();

        if($flush == null){
            $this->session->getFlashBag()->add("info","success");
            $status = "Fotografía eliminada correctamente";
        }else{
            $this->session->getFlashBag()->add("info","error");
            $status = "Error al intentar eliminar la fotografía";
        }
        $this->session->getFlashBag()->add("status",$status);
        return $this->redirectToRoute('cliente_expediente', array("idcliente" => $idcliente));
    }

    public function elimarFotosAction($idcliente){
        $em = $this->getDoctrine()->getManager();

        $fotos = $em->getRepository('LavandaBundle:Expediente')->findBy(array(
            "idcliente" => $idcliente
        ));

        if($fotos != null){
            foreach ($fotos as $foto){
                $ruta = $foto->getRutafoto().$foto->getNombrefoto();
                unlink($ruta);
                $em->remove($foto);
            }
            $flush = $em->flush();

            if($flush == null){
                $this->session->getFlashBag()->add("info","success");
                $status = "Fotografías eliminadas correctamente";
            }else{
                $this->session->getFlashBag()->add("info","error");
                $status = "Error al intentar eliminar las fotografías";
            }
        }else{
            $this->session->getFlashBag()->add("info","error");
            $status = "No se encontraron fotografías";
        }

        $this->session->getFlashBag()->add("status",$status);
        return $this->redirectToRoute('cliente_expediente', array("idcliente" => $idcliente));
    }

    public function showExpedienteClienteAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $cliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
            "idusuario" => $user->getIdusuario()
        ));

        $fotos = $em->getRepository('LavandaBundle:Expediente')->findBy(array(
            "idcliente" => $cliente->getIdcliente()
        ));

        return $this->render('LavandaBundle:Clientes:expediente-cliente.html.twig', array(
            "fotos" => $fotos
        ));
    }

}
