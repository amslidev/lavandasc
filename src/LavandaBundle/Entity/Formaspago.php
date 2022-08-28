<?php

namespace LavandaBundle\Entity;

/**
 * Formaspago
 */
class Formaspago
{
    /**
     * @var int
     */
    private $idformaspago;

    /**
     * @var string|null
     */
    private $nombre;

    /**
     * @var string|null
     */
    private $clave;


    /**
     * Get idformaspago.
     *
     * @return int
     */
    public function getIdformaspago()
    {
        return $this->idformaspago;
    }

    /**
     * Set nombre.
     *
     * @param string|null $nombre
     *
     * @return Formaspago
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
     * @return Formaspago
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

    public function __toString()
    {
        return $this->nombre;
    }
}
