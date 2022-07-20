<?php

namespace LavandaBundle\Entity;

/**
 * Bodegas
 */
class Bodegas
{
    /**
     * @var int
     */
    private $idbodega;

    /**
     * @var string|null
     */
    private $nombre;

    /**
     * @var bool|null
     */
    private $estado;

    /**
     * @var \LavandaBundle\Entity\Sucursal
     */
    private $idsucursal;


    /**
     * Get idbodega.
     *
     * @return int
     */
    public function getIdbodega()
    {
        return $this->idbodega;
    }

    /**
     * Set nombre.
     *
     * @param string|null $nombre
     *
     * @return Bodegas
     */
    public function setNombre($nombre = null)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string|null
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set estado.
     *
     * @param bool|null $estado
     *
     * @return Bodegas
     */
    public function setEstado($estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado.
     *
     * @return bool|null
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set idsucursal.
     *
     * @param \LavandaBundle\Entity\Sucursal|null $idsucursal
     *
     * @return Bodegas
     */
    public function setIdsucursal(\LavandaBundle\Entity\Sucursal $idsucursal = null)
    {
        $this->idsucursal = $idsucursal;

        return $this;
    }

    /**
     * Get idsucursal.
     *
     * @return \LavandaBundle\Entity\Sucursal|null
     */
    public function getIdsucursal()
    {
        return $this->idsucursal;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
