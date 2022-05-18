<?php

namespace LavandaBundle\Entity;

/**
 * Fotosproducto
 */
class Fotosproducto
{
    /**
     * @var integer
     */
    private $idfotoproducto;

    /**
     * @var string
     */
    private $rutaimagen;

    /**
     * @var string
     */
    private $nombreimagen;

    /**
     * @var \LavandaBundle\Entity\Producto
     */
    private $idproducto;


    /**
     * Get idfotoproducto
     *
     * @return integer
     */
    public function getIdfotoproducto()
    {
        return $this->idfotoproducto;
    }

    /**
     * Set rutaimagen
     *
     * @param string $rutaimagen
     *
     * @return Fotosproducto
     */
    public function setRutaimagen($rutaimagen)
    {
        $this->rutaimagen = $rutaimagen;

        return $this;
    }

    /**
     * Get rutaimagen
     *
     * @return string
     */
    public function getRutaimagen()
    {
        return $this->rutaimagen;
    }

    /**
     * Set nombreimagen
     *
     * @param string $nombreimagen
     *
     * @return Fotosproducto
     */
    public function setNombreimagen($nombreimagen)
    {
        $this->nombreimagen = $nombreimagen;

        return $this;
    }

    /**
     * Get nombreimagen
     *
     * @return string
     */
    public function getNombreimagen()
    {
        return $this->nombreimagen;
    }

    /**
     * Set idproducto
     *
     * @param \LavandaBundle\Entity\Producto $idproducto
     *
     * @return Fotosproducto
     */
    public function setIdproducto(\LavandaBundle\Entity\Producto $idproducto = null)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto
     *
     * @return \LavandaBundle\Entity\Producto
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }
}
