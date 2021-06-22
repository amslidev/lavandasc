<?php
/**
 * Created by PhpStorm.
 * User: LEN0V0
 * Date: 20/06/2021
 * Time: 10:52 AM
 */

namespace APIBundle\Services;


use Firebase\JWT\JWT;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class JwtAuth
{
    public $manager;
    public $encoder;
    public $key;

    public function __construct($manager, UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $manager;
        $this->encoder = $encoder;
        $this->key = "9f^cW#r^SW0CszwkxGlNmMm1#";
    }

    public function signup($username, $password){
        $usuario = $this->manager->getRepository("LavandaBundle:Usuario")->findOneBy(array(
           "username"=>$username
        ));

        $passwordValid = $this->encoder->isPasswordValid($usuario, $password);

        if($passwordValid){
            $token = array(
                "sub" => $usuario->getIdusuario(),
                "email" => $usuario->getEmail(),
                "tag" => $usuario->getTaguser(),
                "iat" => time(),
                "exp" => time() + (7*24*60*60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');

            $data = array(
                "data" => "200",
                "user" => $usuario,
                "token" => $jwt
            );
        }else{
            $data = array(
                "status"=>"Error",
                "data"=>"404"
            );
        }
        return $data;
    }

    public function getTokenCliente(){
        $token = array(
            "iat" => time(),
            "exp" => time() + (365*7*24*60*60)
        );

        $jwt = JWT::encode($token, $this->key, 'HS256');

        return $jwt;
    }

    public function checkToken($jwt){
        $auth = false;
        $decoded = null;

        try{
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));
        }catch (\UnexpectedValueException $e){
            $auth = false;
        }catch (\DomainException $d){
            $auth = false;
        }catch (\Exception $e){
            if($e->getMessage() == "Expired Token"){
                $auth= false;
            }
        }

        if(is_object($decoded) || $decoded != null){
            $auth = true;
        }else{
            $auth = false;
        }
        return $auth;
    }
}