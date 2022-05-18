<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APINotificacionesController extends Controller
{
    public function listarAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $email = $request->get('email');
        $token = $request->get('token');

        if($email != "" && $token != ""){
            $cliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
                "email" => $email
            ));

            if($cliente != null){
                $usuario = $em->getRepository('LavandaBundle:Usuario')->findOneBy(array(
                    "idusuario" => $cliente->getIdusuario()->getIdusuario()
                ));

                if($usuario != null){
                    $notificaciones = $em->getRepository('LavandaBundle:Notificaciones')->findBy(array(
                        "idusuario" => $usuario->getIdusuario()
                    ));

                    $arrNot = array();

                    foreach ($notificaciones as $notificacion){
                        array_push($arrNot, [
                            "idnotificacion" => $notificacion->getIdnotificacion(),
                            "titulo" => $notificacion->getTitulo(),
                            "mensaje" => $notificacion->getMensaje(),
                            "fecha" => date_format($notificacion->getFecha(), "Y-m-d H:i:s")
                        ]);
                    }

                    rsort($arrNot );

                    $data = array(
                        "status" => "success",
                        "data" => $arrNot
                    );
                }else{
                    $data = array(
                        "status" => "error",
                        "data" => "No se encontró información del usuario"
                    );
                }
            }else{
                $data = array(
                    "status" => "error",
                    "data" => "No se encontró información del cliente"
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

}
