<?php

namespace LavandaBundle\Entity;

/**
 * Tipocuero
 */
class Tipocuero
{
    /**
     * @var integer
     */
    private $idtipocuero;

    /**
     * @var string
     */
    private $nombre;


    /**
     * Get idtipocuero
     *
     * @return integer
     */
    public function getIdtipocuero()
    {
        return $this->idtipocuero;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tipocuero
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
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
