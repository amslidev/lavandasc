<?php
/**
 * Created by PhpStorm.
 * User: LEN0V0
 * Date: 10/06/2021
 * Time: 08:41 PM
 */

namespace LavandaBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UsuariosController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function loginAction(Request $request){
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render("LavandaBundle:Usuarios:login.html.twig", array(
            "error" => $error,
            "last_Username" => $lastUsername
        ));

    }
}