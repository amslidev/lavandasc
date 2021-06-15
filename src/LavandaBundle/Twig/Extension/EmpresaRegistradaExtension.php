<?php

namespace LavandaBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class EmpresaRegistradaExtension extends \Twig_Extension
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
            new \Twig_SimpleFilter("empresa_registrada", array($this, "getEmpresa"))
        );
    }

    public function getEmpresa($parametro){
        $query = $this->em->createQuery(
            "SELECT e FROM LavandaBundle:Empresa e 
          WHERE e.idempresa IS NOT NULL"
        );
        $query->setMaxResults(1);
        $empresa = $query->getOneOrNullResult();

        if($empresa == null){
            return false;
        }else{
            return true;
        }
    }

    public function getName()
    {
        return 'empresa_registrada';
    }
}
