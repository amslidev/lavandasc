<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class APIHomeController extends Controller
{
    public function tokenAssingAction(){
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);
        $token = $jwt_auth->getTokenCliente();

        $data = array(
          'status'=>'success',
          'token'=>$token
        );

        return $helpers->json($data);
    }
}
