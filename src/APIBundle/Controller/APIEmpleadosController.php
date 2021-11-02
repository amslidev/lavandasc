<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class APIEmpleadosController extends Controller
{
    public function listarEmpleadosAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');
        $idsucursal = $request->get('idsucursal');

        if($token != "" && $idsucursal != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $sucursal = $em->getRepository('LavandaBundle:Sucursal')->find($idsucursal);

                $empleados = $em->getRepository('LavandaBundle:Empleado')->findBy(array(
                    "activo"=>1,
                    "idsucursal" => $sucursal->getIdsucursal()
                ));

                $arrEmp = array();

                foreach ($empleados as $empleado){
                    array_push($arrEmp, [
                        "idempleado"=>$empleado->getIdempleado(),
                        "nombre"=>$empleado->getNombre()." ".$empleado->getApellido(),
                    ]);
                }

                $data = array(
                    "status"=>"success",
                    "data"=>$arrEmp
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

    public function showFotoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idempleado = $request->get('idempleado');

        $empleado = $em->getRepository('LavandaBundle:Empleado')->find($idempleado);

        $logo = $empleado->getRutaimagen()."".$empleado->getNombreimagen();
        $nombreLogo = $empleado->getNombreimagen();
        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $nombreLogo);
        $response->headers->set('Content-Disposition',$disposition);
        $response->headers->set('Content-Type','image/png');
        $response->setContent(file_get_contents($logo));

        return $response;
    }
}
