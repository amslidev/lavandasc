<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Fotosservicio;
use LavandaBundle\Form\FotosservicioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class FotosServiciosController extends Controller
{

    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(Request $request, $idservicio){
        $em = $this->getDoctrine()->getManager();

        $fotos = $em->getRepository('LavandaBundle:Fotosservicio')->findAll();

        $servicio = $em->getRepository('LavandaBundle:Servicio')->find($idservicio);

        if($servicio != null){
            $form = $this->createForm(FotosservicioType::class);
            $form->handleRequest($request);

            if($form->isSubmitted()){
                if($form->isValid()){
                    if(isset($form["fotos"])){
                        $basedir = "uploads/servicios/".$servicio->getIdservicio();

                        if(!file_exists($basedir)){
                            mkdir($basedir, 777, true);
                        }

                        $files = $form["fotos"]->getData();

                        $cont = 0;
                        foreach ($files as $key => $value){
                            $ext = $value->guessExtension();
                            if($ext == "jpg" || $ext == "jpeg" || $ext == "png"){
                                $imgInfo = getimagesize($value);

                                $mime = $imgInfo['mime'];

                                switch ($mime){
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

                                $file_name = "Foto-".$cont.time().".".$ext;
                                $fotoservicio = new Fotosservicio();
                                $fotoservicio->setIdservicio($servicio);
                                $fotoservicio->setRutaimagen($basedir);
                                $fotoservicio->setNombreimagen($file_name);

                                imagejpeg($image, $basedir.$file_name, 60);

                                $em->persist($fotoservicio);
                                $flush = $em->flush();

                                if ($flush == null) {
                                    //$value->move($basedir, $file_name);

                                    $status = "Carga correcta";
                                    $this->session->getFlashBag()->add("info", "success");
                                } else {
                                    $status = "Error en la carga";
                                    $this->session->getFlashBag()->add("info", "error");
                                }

                            }else{
                                $status = "El archivo no tiene una extensión válida";
                                $this->session->getFlashBag()->add("info", "error");
                            }
                            $cont++;
                        }


                    }else{
                        $status = "No se seleccionaron fotos";
                        $this->session->getFlashBag()->add("info", "error");
                        return $this->redirectToRoute('fotosservicio_index', array("idservicio" => $servicio->getIdservicio()));
                    }
                }else{
                    $status = "La información del formulario no es válida";
                    $this->session->getFlashBag()->add("info", "error");
                    return $this->redirectToRoute('fotosservicio_index', array("idservicio" => $servicio->getIdservicio()));
                }

                $status = "Informe de la Operación: " . $status;
                $this->session->getFlashBag()->add("status", $status);
                return $this->redirectToRoute('fotosservicio_index', array("idservicio" => $servicio->getIdservicio()));
            }

        }else{
            $status = "No se encontró el servicio";
            $this->session->getFlashBag()->add("status", $status);
            $this->session->getFlashBag()->add("info", "error");
            return $this->redirectToRoute('servicio_index');
        }

        return $this->render('LavandaBundle:fotosservicio:index.html.twig', array(
            "fotos" => $fotos,
            "form" => $form->createView(),
            "servicio" => $servicio
        ));
    }

    public function elimarFotoAction($idfoto = null){
        $em = $this->getDoctrine()->getManager();

        $foto = $em->getRepository('LavandaBundle:Fotosservicio')->find($idfoto);

        if($foto != null){
            $ruta = $foto->getRutaimagen().$foto->getNombreimagen();

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
            return $this->redirectToRoute('fotosservicio_index', array("idservicio" => $foto->getIdservicio()->getIdservicio()));
        }else{
            $this->session->getFlashBag()->add("info","error");
            $status = "No se encontró información del archivo";
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute('servicio_index');
        }
    }

    public function elimarFotosAction(){
        $em = $this->getDoctrine()->getManager();

        $fotos = $em->getRepository('LavandaBundle:Galeria')->findAll();

        if($fotos != null){
            foreach ($fotos as $foto){
                $ruta = $foto->getRutaimagen().$foto->getNombreimagen();
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
        return $this->redirectToRoute('galeria_index');
    }

}
