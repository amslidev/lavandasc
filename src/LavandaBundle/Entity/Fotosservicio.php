<?php

namespace LavandaBundle\Entity;

/**
 * Fotosservicio
 */
class Fotosservicio
{
    /**
     * @var integer
     */
    private $idfotoservicio;

    /**
     * @var string
     */
    private $rutaimagen;

    /**
     * @var string
     */
    private $nombreimagen;

    /**
     * @var \LavandaBundle\Entity\Servicio
     */
    private $idservicio;


    /**
     * Get idfotoservicio
     *
     * @return integer
     */
    public function getIdfotoservicio()
    {
        return $this->idfotoservicio;
    }

    /**
     * Set rutaimagen
     *
     * @param string $rutaimagen
     *
     * @return Fotosservicio
     */
    public function setRutaimagen($rutaimagen)
    {
        $this->rutaimagen = $rutaimagen;

        return $this;
    }

    /**
     * Get rutaimagen
     *
     * @return string
     */
    public function getRutaimagen()
    {
        return $this->rutaimagen;
    }

    /**
     * Set nombreimagen
     *
     * @param string $nombreimagen
     *
     * @return Fotosservicio
     */
    public function setNombreimagen($nombreimagen)
    {
        $this->nombreimagen = $nombreimagen;

        return $this;
    }

    /**
     * Get nombreimagen
     *
     * @return string
     */
    public function getNombreimagen()
    {
        return $this->nombreimagen;
    }

    /**
     * Set idservicio
     *
     * @param \LavandaBundle\Entity\Servicio $idservicio
     *
     * @return Fotosservicio
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
        return $this->nombreimagen;
    }
}
