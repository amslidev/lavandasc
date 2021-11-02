<?php

namespace LavandaBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\Date;

class ValidarProcesoRegistradoExtension extends \Twig_Extension
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
            new \Twig_SimpleFilter("proceso_registrado", array($this, "getFechaCita"))
        );
    }

    public function getFechaCita($idcita){
        $cita = $this->em->getRepository('LavandaBundle:Citas')->find($idcita);

        $proceso = $this->em->getRepository('LavandaBundle:Procesos')->findOneBy(array(
            "idcita" => $cita->getIdcita()
        ));

        if($proceso != null){
            $result = true;
        }else{
            $result = false;
        }

        return $result;
    }

    public function getName()
    {
        return 'proceso_registrado';
    }
}
