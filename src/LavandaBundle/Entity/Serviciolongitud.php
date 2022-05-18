<?php

namespace LavandaBundle\Entity;

/**
 * Serviciolongitud
 */
class Serviciolongitud
{
    /**
     * @var integer
     */
    private $idserviciolongitud;

    /**
     * @var integer
     */
    private $longitud;

    /**
     * @var float
     */
    private $precio;

    /**
     * @var \LavandaBundle\Entity\Servicio
     */
    private $idservicio;


    /**
     * Get idserviciolongitud
     *
     * @return integer
     */
    public function getIdserviciolongitud()
    {
        return $this->idserviciolongitud;
    }

    /**
     * Set longitud
     *
     * @param integer $longitud
     *
     * @return Serviciolongitud
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return integer
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Serviciolongitud
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set idservicio
     *
     * @param \LavandaBundle\Entity\Servicio $idservicio
     *
     * @return Serviciolongitud
     */
    public function setIdservicio(\LavandaBundle\Entity\Servicio $idservicio = null)
    {
        $this->idservicio = $idservicio;

        return $this;
    }

    /**
     * Get idservicio
     *
     * @return \LavandaBundle\Entity\Servicio
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }

    public function __toString()
    {
        return $this->longitud. " cm";
    }
}
