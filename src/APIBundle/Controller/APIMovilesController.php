<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use LavandaBundle\Entity\Moviles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APIMovilesController extends Controller
{

    public function registrarMovilAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $datos = $request->request->get('data');

        if($datos != ""){
            $params = json_decode($datos);
            $email = (isset($params->email)) ? $params->email : null;
            $token = (isset($params->token)) ? $params->token : null;

            //Buscar los datos del cliente
            $cliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
                "email" => $email
            ));

            if($cliente != null){
                $usuario = $em->getRepository('LavandaBundle:Usuario')->findOneBy(array(
                    "idusuario" => $cliente->getIdusuario()->getIdusuario()
                ));

                if($usuario != null){
                    $movil = new Moviles();

                    $movil->setIdusuario($usuario);
                    $movil->setToken($token);
                    $movil->setFecharegistro(new \DateTime("now"));

                    $em->persist($movil);
                    $flush = $em->flush();

                    if($flush == null){
                        $data = array(
                            "status" => "success",
                            "data" => "Ok",
                            "movil" => $movil
                        );
                    }else{
                        $data = array(
                            "status" => "error",
                            "data" => "No se registró el dispositivo móvil"
                        );
                    }
                }else{
                    $data = array(
                        "status" => "error",
                        "data" => "No se encontró información de este usuario"
                    );
                }
            }else{
                $data = array(
                    "status" => "error",
                    "data" => "No se encontró información de este cliente"
                );
            }
        }else{
            $data = array(
                "status" => "error",
                "data" => "Faltan datos"
            );
        }

        return $helpers->json($data);
    }

    public function eliminarDispositivoAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $solicitud = $request->request->get('data');

        $data = array(
            'status' => 'error',
            'data' => 'Send json valid'
        );

        if($data != null){
            $info = json_decode($solicitud, true);

            $tokenFCM = $info["tokenFCM"];

            //Buscar el dispositivo
            $dispositivo = $em->getRepository('LavandaBundle:Moviles')->findOneBy(array(
                "token" => $tokenFCM
            ));

            if($dispositivo != null){
                $em->remove($dispositivo);
                $em->flush();

                $data = array(
                    'status' => 'success',
                    'data' => 'Datos eliminados correctamente'
                );
            }else{
                $data = array(
                    'status' => 'error',
                    'data' => 'No se encontró información del dispositivo'
                );
            }

        }else{
            $data = array(
                'status' => 'error',
                'data' => 'Faltan datos'
            );
        }

        return $helpers->json($data);
    }
}
