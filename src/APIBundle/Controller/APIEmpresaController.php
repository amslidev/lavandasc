<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class APIEmpresaController extends Controller
{
    public function showInfoAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');

        if($token != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $query = $em->createQuery(
                    "SELECT e FROM LavandaBundle:Empresa e 
                    WHERE e.idempresa IS NOT NULL"
                );
                $query->setMaxResults(1);
                $empresa = $query->getOneOrNullResult();

                /*$arrEmpresa = array();

                array_push($arrEmpresa, [
                   "id" => $empresa->getIdempresa(),
                    "razonSocial" => $empresa->getRazonsocial(),
                    "mision"=>$empresa->getMision(),
                    "vision"=>$empresa->getVision(),
                    "valores"=>$empresa->getValores()
                ]);*/

                $data = array(
                    "status" => "success",
                    "empresa" => $empresa
                );
            }else{
                $data = array(
                    'status'=>'error',
                    'data' => 'Faltan datos'
                );
            }

            return $helpers->json($data);
        }

    }

    public function showLogoAction(){
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            "SELECT e FROM LavandaBundle:Empresa e 
                    WHERE e.idempresa IS NOT NULL"
        );
        $query->setMaxResults(1);
        $empresa = $query->getOneOrNullResult();

        $logo = $empresa->getRutalogo().$empresa->getNombrelogo();
        $nombreLogo = $empresa->getNombrelogo();
        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $nombreLogo);
        $response->headers->set('Content-Disposition',$disposition);
        $response->headers->set('Content-Type','image/png');
        $response->setContent(file_get_contents($logo));

        return $response;
    }
}
