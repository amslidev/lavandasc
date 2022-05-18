<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class APIProcesosController extends Controller
{

    public function listarProcesosAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $idcita = $request->get('idcita');
        $token = $request->get('token');

        if($idcita != "" && $token != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $proceso = $em->getRepository('LavandaBundle:Procesos')->findOneBy(array(
                    "idcita" => $idcita
                ));

                $oProceso = new \stdClass();

                if($proceso != null){
                    $oProceso->idProceso = $proceso->getIdproceso();
                    $oProceso->fechaProceso = date_format($proceso->getFechaproceso(), "Y-m-d");
                    $oProceso->procedimiento = $proceso->getProcedimiento();
                    $oProceso->productos = $proceso->getProductos();
                    $oProceso->comentarios = $proceso->getComentarios();
                    $oProceso->proximaCita = date_format($proceso->getFechaproximacita(), "Y-m-d");

                    $arrProceso = json_decode(json_encode($oProceso), true);

                    $data = array(
                        "status"=>"success",
                        "data"=> $arrProceso
                    );
                }else{
                    $data = array(
                        "status"=>"error",
                        "data"=>"No se encontró información del proceso"
                    );
                }
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

    public function mostrarFotoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idproceso = $request->get('idproceso');
        $opcion = $request->get('opcion');

        $proceso = $em->getRepository('LavandaBundle:Procesos')->find($idproceso);

        if($opcion == 1){
            $logo = $proceso->getRutafotoantes()."".$proceso->getNombrefotoantes();
            $nombreLogo = $proceso->getNombrefotoantes();
        }else{
            $logo = $proceso->getRutafotodesp()."".$proceso->getNombrefotodesp();
            $nombreLogo = $proceso->getNombrefotodesp();
        }

        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $nombreLogo);
        $response->headers->set('Content-Disposition',$disposition);
        $response->headers->set('Content-Type','image/png');
        $response->setContent(file_get_contents($logo));

        return $response;
    }
}
