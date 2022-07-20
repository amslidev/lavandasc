<?php

namespace LavandaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class BarController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function posAction()
    {
        return $this->render('LavandaBundle:Bar:pos.html.twig');
    }



}
