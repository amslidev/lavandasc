<?php

namespace LavandaBundle\Entity;

/**
 * Unidadesmedida
 */
class Unidadesmedida
{
    /**
     * @var int
     */
    private $idunidadesmedida;

    /**
     * @var string|null
     */
    private $nombre;


    /**
     * Get idunidadesmedida.
     *
     * @return int
     */
    public function getIdunidadesmedida()
    {
        return $this->idunidadesmedida;
    }

    /**
     * Set nombre.
     *
     * @param string|null $nombre
     *
     * @return Unidadesmedida
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

    public function __toString()
    {
        return $this->nombre;
    }
}
