<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APICortesiasController extends Controller
{
    public function cortesiasListadoAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');

        if($token != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $cortesias = $em->getRepository('LavandaBundle:Cortesias')->findBy(array(
                    "disponible"=>1
                ));

                $arrCortesias = array();

                foreach ($cortesias as $cortesia){
                    array_push($arrCortesias, [
                        "idcortesia"=>$cortesia->getIdcortesia(),
                        "nombre"=>$cortesia->getNombre(),
                        "descripcion"=>$cortesia->getDescripcion()
                    ]);
                }

                $data = array(
                    "status"=>"success",
                    "data"=>$arrCortesias
                );
            }else{
                $data = array(
                    "status"=>"error",
                    "data"=>"El token no es válido"
                );
            }
        }else{
            $data = array(
                "status"=>"error",
                "data"=>"Faltan datos"
            );
        }
        return $helpers->json($data);
    }
}
