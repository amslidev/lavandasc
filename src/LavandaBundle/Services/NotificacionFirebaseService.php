<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 09/11/2021
 * Time: 06:21 PM
 */

namespace LavandaBundle\Services;


use LavandaBundle\Entity\Notificaciones;

class NotificacionFirebaseService
{
    public $em;

    public function __construct($manager)
    {
        $this->em = $manager;
    }

    public function enviarNotificacion($idusuario, $titulo, $mensaje){

        $em = $this->em;

        $apiKey = $em->getRepository('LavandaBundle:Globales')->findOneBy(array("clave" => "APIFCM"))->getValor();


        $headers = array('Authorization: key='.$apiKey,'Content-Type: application/json');

        $url = 'https://fcm.googleapis.com/fcm/send';

        $dispositivos = $em->getRepository('LavandaBundle:Moviles')->findBy(array(
            "idusuario" => $idusuario
        ));

        $usuario = $em->getRepository('LavandaBundle:Usuario')->find($idusuario);

        if(count($dispositivos) > 0){
            foreach ($dispositivos as $dispositivo){
                $json = array(
                    "notification" => array(
                        "body" => $mensaje,
                        "title" => $titulo,
                        
                    ),
                    "priority" => "high",
                    "data" => array(
                        "juego" => $mensaje,
                        "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
                    ),
                    "to" => $dispositivo->getToken(),

                );

                $fields = json_encode($json);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,  true);

                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

                $result = curl_exec($ch);
                curl_close($ch);
            }

            $notificacion = new Notificaciones();
            $notificacion->setIdusuario($usuario);
            $notificacion->setTitulo($titulo);
            $notificacion->setMensaje($mensaje);
            $notificacion->setFecha(new \DateTime("now"));

            $em->persist($notificacion);
            $em->flush();

            return "1";
        }
    }
}