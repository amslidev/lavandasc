<?php

namespace LavandaBundle\Services;

use LavandaBundle\Entity\Barventa;
use LavandaBundle\Entity\Bitacoraventas;
use LavandaBundle\Entity\Usuario;
use Symfony\Component\Security\Core\User\UserInterface;

class BitacoraVentasService
{
    public $em;

    public function __construct($manager)
    {
        $this->em = $manager;
    }

    public function registrarEvento(Barventa $barventa, $evento, $idusuario){
        $em = $this->em;

        $user = $em->getRepository('LavandaBundle:Usuario')->find($idusuario);

        $bitacora = new Bitacoraventas();
        $bitacora->setIdbarventa($barventa);
        $bitacora->setEvento($evento);
        $bitacora->setIdusuario($user);
        $bitacora->setFecha(new \DateTime("now"));

        $em->persist($bitacora);
        $em->flush();
    }
}