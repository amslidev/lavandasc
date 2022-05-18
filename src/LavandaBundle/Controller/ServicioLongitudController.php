<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Serviciolongitud;
use LavandaBundle\Form\ServiciolongitudType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ServicioLongitudController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(Request $request, $idservicio){
        $em = $this->getDoctrine()->getManager();

        $servicio = $em->getRepository('LavandaBundle:Servicio')->find($idservicio);

        $servicioLongitud = new Serviciolongitud();

        $form = $this->createForm(ServiciolongitudType::class, $servicioLongitud);
        $form->handleRequest($request);

        $longitudes = $em->getRepository('LavandaBundle:Serviciolongitud')->findBy(array(
            "idservicio" => $servicio->getIdservicio()
        ));

        $longitudSeleccionada = $form->get('longitud')->getData();

        if($form->isSubmitted()){
            if($form->isValid()){
                $longitudRegistro = $em->getRepository('LavandaBundle:Serviciolongitud')->findOneBy(array(
                    "longitud" => $longitudSeleccionada,
                    "idservicio" => $idservicio
                ));

                if($longitudRegistro == null){
                    $servicioLongitud->setIdservicio($servicio);

                    $em->persist($servicioLongitud);

                    $flush = $em->flush();

                    if($flush == null){
                        $status = "Información registrada correctamente";
                        $this->session->getFlashBag()->add("info", "success");
                    }else{
                        $status = "Error al intentar registrar la información";
                        $this->session->getFlashBag()->add("info", "error");
                    }
                }else{
                    $status = "Esta longitud ya fue registrada para este servicio";
                    $this->session->getFlashBag()->add("info", "error");
                }
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute('serviciolongitud_index', array("idservicio" => $servicio->getIdservicio()));
        }

        return $this->render('LavandaBundle:Serviciolongitud:index.html.twig', array(
            "servicio" => $servicio,
            "form" => $form->createView(),
            "longitudes" => $longitudes
        ));
    }

    public function editarAction(Request $request, $idlongitud = null){
        $em = $this->getDoctrine()->getManager();

        $longitud = $em->getRepository('LavandaBundle:Serviciolongitud')->find($idlongitud);

        $lonActual = $longitud->getLongitud();

        $form = $this->createForm(ServiciolongitudType::class, $longitud);
        $form->handleRequest($request);

        $servicio = $em->getRepository('LavandaBundle:Servicio')->findOneBy(array(
            "idservicio" => $longitud->getIdservicio()->getIdservicio()
        ));

        if($form->isSubmitted()){
            if($form->isValid()){
                $longitud->setLongitud($lonActual);
                $em->persist($longitud);
                $flush = $em->flush();

                if($flush == null){
                    $status = "Información editada correctamente";
                    $this->session->getFlashBag()->add("info", "success");
                }else{
                    $status = "Error al intentar editar la información";
                    $this->session->getFlashBag()->add("info", "success");
                }
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute('serviciolongitud_index', array("idservicio" => $servicio->getIdservicio()));
            }
        }

        return $this->render('LavandaBundle:Serviciolongitud:edit.html.twig', array(
            "form" => $form->createView(),
            "longitud" => $longitud
        ));
    }

    public function eliminarAction($idlongitud, $idservicio){
        $em = $this->getDoctrine()->getManager();

        $longitud = $em->getRepository('LavandaBundle:Serviciolongitud')->find($idlongitud);

        if($longitud != null){
            $em->remove($longitud);
            $flush = $em->flush();

            if($flush == null){
                $status = "Información eliminada correctamente";
                $this->session->getFlashBag()->add("info", "success");
            }else{
                $status = "Error al eliminar la información";
                $this->session->getFlashBag()->add("info", "success");
            }
        }else{
            $status = "No se encontró información";
            $this->session->getFlashBag()->add("info", "success");
        }
        $this->session->getFlashBag()->add("status",$status);
        return $this->redirectToRoute('serviciolongitud_index', array("idservicio" => $idservicio));
    }

    public function listarLongitudServicioAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idservicio = $request->get('idservicio');

        $longitudes = $em->getRepository('LavandaBundle:Serviciolongitud')->findBy(array(
            "idservicio" => $idservicio
        ));

        $arrLongitudes = array();

        foreach ($longitudes as $longitud){
            array_push($arrLongitudes, [
               "idserviciolongitud" => $longitud->getIdserviciolongitud(),
               "longitud" => $longitud->getLongitud()
            ]);
        }

        return new JsonResponse($arrLongitudes);
    }

}
