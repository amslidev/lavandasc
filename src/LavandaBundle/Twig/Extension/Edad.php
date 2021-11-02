<?php

namespace LavandaBundle\Twig\Extension;

class Edad extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter("edad", array($this, 'getEncuesta'))
        );
    }

    public function getEncuesta($fechaNacimiento){
        $diaActual = date("Y-m-d");
        $edad = date_diff(date_create($fechaNacimiento), date_create($diaActual));
        return $edad->y;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'edad';
    }


}
