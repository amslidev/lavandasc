<?php

namespace LavandaBundle\Services;

use LavandaBundle\Entity\Logs;

class LogsService
{

    public $em;

    public function __construct($manager)
    {
        $this->em = $manager;
    }

    public function registrarLog($idusuario, $modulo, $evento){
        $em = $this->em;

        $user = $em->getRepository('LavandaBundle:Usuario')->find($idusuario);

        $log = new Logs();
        $log->setIdusuario($user);
        $log->setModulo($modulo);
        $log->setEvento($evento);
        $log->setFecha(new \DateTime("now"));

        $em->persist($log);
        $em->flush();
    }
}