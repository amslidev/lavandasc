<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APIServicioLongitudController extends Controller
{

    public function listarServicioLongitudAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');
        $idservicio = $request->get('idservicio');

        if($token != "" && $idservicio != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $longitudes = $em->getRepository('LavandaBundle:Serviciolongitud')->findBy(array(
                    "idservicio" => $idservicio
                ));

                $arrLongitudes = array();

                foreach ($longitudes as $longitud){
                    array_push($arrLongitudes, [
                        "idserviciolongitud" => $longitud->getIdserviciolongitud(),
                        "longitud" => $longitud->getLongitud(),
                        "precio" => $longitud->getPrecio()
                    ]);
                }

                $data = array(
                    'status'=>'success',
                    'data' => $arrLongitudes
                );
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
