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

                    $encuesta->setOpcion1($info["opcion1"]);
                    $encuesta->setOpcion2($info["opcion2"]);
                    $encuesta->setOpcion3($info["opcion3"]);
                    $encuesta->setOpcion4($info["opcion4"]);
                    $encuesta->setOpcion5($info["opcion5"]);
                    $encuesta->setOpcion6($info["opcion6"]);
                    $encuesta->setOpcion7($info["opcion7"]);
                    $encuesta->setOpcion8($info["opcion8"]);
                    $encuesta->setOpcion9($info["opcion9"]);
                    $encuesta->setOpcion10($info["opcion10"]);
                    $encuesta->setOpcion11($info["opcion11"]);

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
