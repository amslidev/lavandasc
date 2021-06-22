<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APIServiciosController extends Controller
{
    public function listarServiciosIndexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');

        if($token != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $servicios = $em->getRepository('LavandaBundle:Servicio')->findAll();

                $arrServicios = array();

                foreach ($servicios as $servicio){
                    array_push($arrServicios, [
                        "idservicio" => $servicio->getIdservicio(),
                        "nombre" => $servicio->getNombre(),
                        "tiempo" => $servicio->getTiempo(),
                        "precio" => number_format($servicio->getPrecio(),2,".",","),
                        "descripcion" => $servicio->getDescripcion()
                    ]);
                }

                $data = array(
                    'status'=>'success',
                    'data' => $arrServicios
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
