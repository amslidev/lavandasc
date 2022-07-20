<?php

namespace LavandaBundle\Entity;

/**
 * Cortesiaproducto
 */
class Cortesiaproducto
{
    /**
     * @var int
     */
    private $idcortesiaproducto;

    /**
     * @var int|null
     */
    private $cantidad;

    /**
     * @var \LavandaBundle\Entity\Cortesias
     */
    private $idcortesia;

    /**
     * @var \LavandaBundle\Entity\Producto
     */
    private $idproducto;


    /**
     * Get idcortesiaproducto.
     *
     * @return int
     */
    public function getIdcortesiaproducto()
    {
        return $this->idcortesiaproducto;
    }

    /**
     * Set cantidad.
     *
     * @param int|null $cantidad
     *
     * @return Cortesiaproducto
     */
    public function setCantidad($cantidad = null)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad.
     *
     * @return int|null
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set idcortesia.
     *
     * @param \LavandaBundle\Entity\Cortesias|null $idcortesia
     *
     * @return Cortesiaproducto
     */
    public function setIdcortesia(\LavandaBundle\Entity\Cortesias $idcortesia = null)
    {
        $this->idcortesia = $idcortesia;

        return $this;
    }

    /**
     * Get idcortesia.
     *
     * @return \LavandaBundle\Entity\Cortesias|null
     */
    public function getIdcortesia()
    {
        return $this->idcortesia;
    }

    /**
     * Set idproducto.
     *
     * @param \LavandaBundle\Entity\Producto|null $idproducto
     *
     * @return Cortesiaproducto
     */
    public function setIdproducto(\LavandaBundle\Entity\Producto $idproducto = null)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto.
     *
     * @return \LavandaBundle\Entity\Producto|null
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }
}
