<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

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
                        "cobroOnza" => $servicio->getCobraronza() == true ? "S" : "N",
                        "precio" => number_format($servicio->getPrecio(),2,'.',''),
                        "descripcion" => $servicio->getDescripcion()
                    ]);
                }

                $data = array(
                    'status'=>'success',
                    'data' => $arrServicios
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

    public function showLogoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idservicio = $request->get('idservicio');

        $servicio = $em->getRepository('LavandaBundle:Servicio')->find($idservicio);

        $logo = $servicio->getRutaimagen().$servicio->getNombreimagen();
        $nombreLogo = $servicio->getNombreimagen();
        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $nombreLogo);
        $response->headers->set('Content-Disposition',$disposition);
        $response->headers->set('Content-Type','image/jpeg');
        $response->setContent(file_get_contents($logo));

        return $response;
    }
}
