<?php

namespace LavandaBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class NombreEmpresaExtension extends \Twig_Extension
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
            new \Twig_SimpleFilter("nombre_empresa", array($this, 'getNombreEmpresa'))
        );
    }

    public function getNombreEmpresa($parametro){
        $query = $this->em->createQuery(
          "SELECT e FROM LavandaBundle:Empresa e 
          WHERE e.idempresa IS NOT NULL"
        );
        $query->setMaxResults(1);
        $empresa = $query->getOneOrNullResult();

        if($empresa == null){
            return "SCADMIN";
        }else{
            return $empresa->getRazonsocial();
        }
    }

    public function getName()
    {
        return 'nombre_empresa';
    }
}
