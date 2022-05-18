<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APISucursalesController extends Controller
{

    public function listarSucursalesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');

        if($token != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $sucursales = $em->getRepository('LavandaBundle:Sucursal')->findBy(array(
                    "activo" => 1
                ));

                $arrSucursales = array();

                foreach ($sucursales as $sucursal){
                    array_push($arrSucursales, [
                        "idSucursal" => $sucursal->getIdsucursal(),
                        "nombre" => $sucursal->getNombre()
                    ]);
                }

                $data = array(
                    "status"=>"success",
                    "data"=>$arrSucursales
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
