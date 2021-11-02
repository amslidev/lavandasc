<?php

namespace LavandaBundle\Entity;

/**
 * Estatuscita
 */
class Estatuscita
{
    /**
     * @var integer
     */
    private $idestatus;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get idestatus
     *
     * @return integer
     */
    public function getIdestatus()
    {
        return $this->idestatus;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Estatuscita
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    /**
     * @var string
     */
    private $clave;


    /**
     * Set clave
     *
     * @param string $clave
     *
     * @return Estatuscita
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }
}
