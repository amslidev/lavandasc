<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class APIProductosController extends Controller
{

    public function indexProductosAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');

        if($token !=""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $productos = $em->getRepository('LavandaBundle:Producto')->findAll();

                $arrProductos = array();

                foreach ($productos as $producto){
                    array_push($arrProductos,[
                        "idproducto"=>$producto->getIdproducto(),
                        "nombre"=>$producto->getNombre(),
                        "descripcion"=>$producto->getDescripcion(),
                        "precio" => number_format($producto->getPrecio(),2,'.',''),
                    ]);
                }

                $data = array(
                    "status"=>"success",
                    "data"=>$arrProductos
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

    public function showLogoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idproducto = $request->get('idproducto');

        $producto = $em->getRepository('LavandaBundle:Producto')->find($idproducto);

        $logo = $producto->getRutaimagen().$producto->getNombreimagen();
        $nombreLogo = $producto->getNombreimagen();
        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $nombreLogo);
        $response->headers->set('Content-Disposition',$disposition);
        $response->headers->set('Content-Type','image/jpeg');
        $response->setContent(file_get_contents($logo));

        return $response;
    }
}
