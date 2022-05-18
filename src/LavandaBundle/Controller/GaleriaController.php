<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Galeria;
use LavandaBundle\Form\GaleriaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class GaleriaController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $fotos = $em->getRepository('LavandaBundle:Galeria')->findAll();

        $form = $this->createForm(GaleriaType::class);
        $form->handleRequest($request);

        if($form->isValid()){
            if($form->isSubmitted()){
                if(isset($form["fotos"])){
                    $basedir = "uploads/galeria/";

                    if (!file_exists($basedir)) {
                        mkdir($basedir, 777, true);
                    }
                    $files = $form["fotos"]->getData();

                    $cont = 0;
                    foreach ($files as $key => $value){
                        $ext = $value->guessExtension();
                        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {

                            //comprimir la imagen
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
                            $galeria = new Galeria();
                            $galeria->setNombreimagen($file_name);
                            $galeria->setRutaimagen($basedir);
                            $galeria->setFechacarga(new \DateTime("now"));

                            imagejpeg($image, $basedir.$file_name, 60);

                            $em->persist($galeria);
                            $flush = $em->flush();

                            if ($flush == null) {
                                //$value->move($basedir, $file_name);

                                $status = "Carga correcta";
                                $this->session->getFlashBag()->add("info", "success");
                            } else {
                                $status = "Error en la carga";
                                $this->session->getFlashBag()->add("info", "error");
                            }
                        } else {
                            $status = "El archivo no tiene una extensión válida";
                            $this->session->getFlashBag()->add("info", "error");
                        }
                        $cont++;
                    }

                }else{
                    $status = "No se seleccionaron imágenes";
                    $this->session->getFlashBag()->add("info", "error");
                }
            }
            $status = "Informe de la Operación: " . $status;
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute('galeria_index');
        }

        return $this->render('LavandaBundle:Galeria:index.html.twig', array(
            "fotos" => $fotos,
            "form" => $form->createView()
        ));
    }

    public function elimarFotoAction($idfoto = null){
        $em = $this->getDoctrine()->getManager();

        $foto = $em->getRepository('LavandaBundle:Galeria')->find($idfoto);

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
        return $this->redirectToRoute('galeria_index');
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
