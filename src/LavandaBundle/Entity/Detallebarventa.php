<?php

namespace LavandaBundle\Entity;

/**
 * Detallebarventa
 */
class Detallebarventa
{
    /**
     * @var int
     */
    private $iddetallebarventa;

    /**
     * @var int|null
     */
    private $cantidad;

    /**
     * @var float|null
     */
    private $subtotal;

    /**
     * @var \LavandaBundle\Entity\Barventa
     */
    private $idbarventa;

    /**
     * @var \LavandaBundle\Entity\Producto
     */
    private $idproducto;


    /**
     * Get iddetallebarventa.
     *
     * @return int
     */
    public function getIddetallebarventa()
    {
        return $this->iddetallebarventa;
    }

    /**
     * Set cantidad.
     *
     * @param int|null $cantidad
     *
     * @return Detallebarventa
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
     * Set subtotal.
     *
     * @param float|null $subtotal
     *
     * @return Detallebarventa
     */
    public function setSubtotal($subtotal = null)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal.
     *
     * @return float|null
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set idbarventa.
     *
     * @param \LavandaBundle\Entity\Barventa|null $idbarventa
     *
     * @return Detallebarventa
     */
    public function setIdbarventa(\LavandaBundle\Entity\Barventa $idbarventa = null)
    {
        $this->idbarventa = $idbarventa;

        return $this;
    }

    /**
     * Get idbarventa.
     *
     * @return \LavandaBundle\Entity\Barventa|null
     */
    public function getIdbarventa()
    {
        return $this->idbarventa;
    }

    /**
     * Set idproducto.
     *
     * @param \LavandaBundle\Entity\Producto|null $idproducto
     *
     * @return Detallebarventa
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
    /**
     * @var \LavandaBundle\Entity\Cortesias
     */
    private $idcortesia;


    /**
     * Set idcortesia.
     *
     * @param \LavandaBundle\Entity\Cortesias|null $idcortesia
     *
     * @return Detallebarventa
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
}
