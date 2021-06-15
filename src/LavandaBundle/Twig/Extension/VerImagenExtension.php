<?php

namespace LavandaBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class VerImagenExtension extends \Twig_Extension
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
            new \Twig_SimpleFilter("ver_imagen", array($this, 'getLogo'))
        );
    }

    public function getLogo($parametro){
        $query = $this->em->createQuery(
            "SELECT e FROM LavandaBundle:Empresa e 
          WHERE e.idempresa IS NOT NULL"
        );
        $query->setMaxResults(1);
        $empresa = $query->getOneOrNullResult();

        return $empresa->getRutalogo().$empresa->getNombrelogo();
    }

    public function getName()
    {
        return 'ver_imagen';
    }
}
