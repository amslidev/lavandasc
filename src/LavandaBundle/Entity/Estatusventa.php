<?php

namespace LavandaBundle\Entity;

/**
 * Estatusventa
 */
class Estatusventa
{
    /**
     * @var int
     */
    private $idestatusventa;

    /**
     * @var string|null
     */
    private $nombre;

    /**
     * @var string|null
     */
    private $clave;


    /**
     * Get idestatusventa.
     *
     * @return int
     */
    public function getIdestatusventa()
    {
        return $this->idestatusventa;
    }

    /**
     * Set nombre.
     *
     * @param string|null $nombre
     *
     * @return Estatusventa
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
     * Set clave.
     *
     * @param string|null $clave
     *
     * @return Estatusventa
     */
    public function setClave($clave = null)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave.
     *
     * @return string|null
     */
    public function getClave()
    {
        return $this->clave;
    }
}
