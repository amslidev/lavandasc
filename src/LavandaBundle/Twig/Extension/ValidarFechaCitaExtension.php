<?php

namespace LavandaBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\Date;

class ValidarFechaCitaExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter("fecha_cita", array($this, "getFechaCita"))
        );
    }

    public function getFechaCita($idcita){
        $cita = $this->em->getRepository('LavandaBundle:Citas')->find($idcita);

        $fechaActual = new \DateTime("now");

        if($fechaActual < $cita->getFechacita()){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    public function getName()
    {
        return 'fecha_cita';
    }
}
