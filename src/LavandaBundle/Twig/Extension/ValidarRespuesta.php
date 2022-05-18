<?php

namespace LavandaBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class ValidarRespuesta extends \Twig_Extension
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
          new \Twig_SimpleFilter("validar_respuesta", array($this, 'getRespuesta'))
        );
    }

    public function getRespuesta($respuesta){
        if($respuesta == "1"){
            $result = "Totalmente en desacuerdo";
        }else if($respuesta == "2"){
            $result = "Desacuerdo";
        }else if($respuesta == "3"){
            $result = "Ni de acuerdo ni en desacuerdo";
        }else if($respuesta == "4"){
            $result = "De acuerdo";
        }else if($respuesta == "5"){
            $result = "Totalmente de acuerdo";
        }else{
            $result = "Respuesta no válida";
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'validar_respuesta';
    }
}
