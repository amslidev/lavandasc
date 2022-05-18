<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class APIGaleriaController extends Controller
{

    public function listarGaleriaAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');

        if($token != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $fotos = $em->getRepository('LavandaBundle:Galeria')->findAll();

                $arrFotos = array();

                foreach ($fotos as $foto){
                    array_push($arrFotos, [
                       "idGaleria" => $foto->getIdgaleria(),
                       "nombreImagen" => $foto->getNombreimagen(),
                        "fechaCarga" => date_format($foto->getFechacarga(), "Y-m-d")
                    ]);
                }

                $data = array(
                    "status" => "success",
                    "data" => $arrFotos
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

    public function visualizarFotoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idfoto = $request->get('idfoto');

        $foto = $em->getRepository('LavandaBundle:Galeria')->find($idfoto);
        $fotoApp = $foto->getRutaimagen()."".$foto->getNombreimagen();
        $nombreFoto = $foto->getNombreimagen();
        $response = new Response();

        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $nombreFoto);
        $response->headers->set('Content-Disposition',$disposition);
        $response->headers->set('Content-Type','image/png');
        $response->setContent(file_get_contents($fotoApp));

        return $response;
    }

}
