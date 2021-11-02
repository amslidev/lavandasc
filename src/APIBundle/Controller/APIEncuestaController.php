<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use LavandaBundle\Entity\Encuesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APIEncuestaController extends Controller
{
    public function registrarEncuestaAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->request->get('token');
        $encuesta = $request->request->get('encuesta');
        $email = $request->request->get('email');

        if($token != "" && $encuesta != null){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                //Buscar los datos del cliente
                $cliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
                    "email"=>$email
                ));

                $info = json_decode($encuesta, true);

                //Verificar que el cliente no haya contestado previamente la encuesta
                $encuestaPrevia = $em->getRepository('LavandaBundle:Encuesta')->findOneBy(array(
                    "idcliente"=>$cliente->getIdcliente()
                ));

                if($encuestaPrevia == null){
                    $encuesta = new Encuesta();
                    $encuesta->setIdcliente($cliente);
                    $encuesta->setPregunta1($info["pregunta1"]);
                    $encuesta->setOpcion1($info["opcion1"]);
                    $encuesta->setPregunta2($info["pregunta2"]);
                    $encuesta->setOpcion2($info["opcion2"]);
                    $encuesta->setPregunta3($info["pregunta3"]);
                    $encuesta->setPregunta4($info["pregunta4"]);
                    $encuesta->setPregunta5($info["pregunta5"]);
                    $encuesta->setPregunta6($info["pregunta6"]);
                    $encuesta->setFecharegistro(new \DateTime("now"));

                    $em->persist($encuesta);
                    $flush = $em->flush();

                    if($flush == null){
                        $data = array(
                            'status'=>'success',
                            'data' => '¡Gracias por sus respuesta!'
                        );
                    }else{
                        $data = array(
                            'status'=>'error',
                            'data' => 'Error al intentar registrar las respuestas de la encuesta'
                        );
                    }
                }else{
                    $data = array(
                        'status'=>'error',
                        'data' => 'Ya contestó nuestra encuesta con anterioridad'
                    );
                }

            }else{
                $data = array(
                    'status'=>'error',
                    'data' => 'El token no es válido'
                );
            }
        }else{
            $data = array(
                'status'=>'error',
                'data' => 'Faltan datos'
            );
        }
        return $helpers->json($data);
    }
}
