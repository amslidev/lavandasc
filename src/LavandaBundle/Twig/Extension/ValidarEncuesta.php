<?php

namespace LavandaBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class ValidarEncuesta extends \Twig_Extension
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
            new \Twig_SimpleFilter("validar_encuesta", array($this, 'getEncuesta'))
        );
    }

    public function getEncuesta($idcliente){
        $encuesta = $this->em->getRepository('LavandaBundle:Encuesta')->findOneBy(array(
            "idcliente"=>$idcliente
        ));

        if($encuesta != null){
            return  true;
        }else{
            return false;
        }
    }

    public function getName()
    {
        return 'validar_encuesta';
    }
}
