<?php

namespace LavandaBundle\Entity;

/**
 * Servicioproducto
 */
class Servicioproducto
{
    /**
     * @var int
     */
    private $idservicioproducto;

    /**
     * @var int|null
     */
    private $cantidad;

    /**
     * @var \LavandaBundle\Entity\Producto
     */
    private $idproducto;

    /**
     * @var \LavandaBundle\Entity\Servicio
     */
    private $idservicio;


    /**
     * Get idservicioproducto.
     *
     * @return int
     */
    public function getIdservicioproducto()
    {
        return $this->idservicioproducto;
    }

    /**
     * Set cantidad.
     *
     * @param int|null $cantidad
     *
     * @return Servicioproducto
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
     * Set idproducto.
     *
     * @param \LavandaBundle\Entity\Producto|null $idproducto
     *
     * @return Servicioproducto
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
     * Set idservicio.
     *
     * @param \LavandaBundle\Entity\Servicio|null $idservicio
     *
     * @return Servicioproducto
     */
    public function setIdservicio(\LavandaBundle\Entity\Servicio $idservicio = null)
    {
        $this->idservicio = $idservicio;

        return $this;
    }

    /**
     * Get idservicio.
     *
     * @return \LavandaBundle\Entity\Servicio|null
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }
}
