<?php

namespace LavandaBundle\Entity;

/**
 * Diagnostico
 */
class Diagnostico
{
    /**
     * @var integer
     */
    private $iddiagnostico;

    /**
     * @var string
     */
    private $nombre;


    /**
     * Get iddiagnostico
     *
     * @return integer
     */
    public function getIddiagnostico()
    {
        return $this->iddiagnostico;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Diagnostico
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
