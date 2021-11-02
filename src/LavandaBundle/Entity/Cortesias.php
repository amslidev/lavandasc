<?php

namespace LavandaBundle\Entity;

/**
 * Cortesias
 */
class Cortesias
{
    /**
     * @var integer
     */
    private $idcortesia;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var boolean
     */
    private $disponible;

    /**
     * @var \DateTime
     */
    private $fechaingreso;

    /**
     * @var \DateTime
     */
    private $fechasalida;


    /**
     * Get idcortesia
     *
     * @return integer
     */
    public function getIdcortesia()
    {
        return $this->idcortesia;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cortesias
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

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Cortesias
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
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Cortesias
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set fechaingreso
     *
     * @param \DateTime $fechaingreso
     *
     * @return Cortesias
     */
    public function setFechaingreso($fechaingreso)
    {
        $this->fechaingreso = $fechaingreso;

        return $this;
    }

    /**
     * Get fechaingreso
     *
     * @return \DateTime
     */
    public function getFechaingreso()
    {
        return $this->fechaingreso;
    }

    /**
     * Set fechasalida
     *
     * @param \DateTime $fechasalida
     *
     * @return Cortesias
     */
    public function setFechasalida($fechasalida)
    {
        $this->fechasalida = $fechasalida;

        return $this;
    }

    /**
     * Get fechasalida
     *
     * @return \DateTime
     */
    public function getFechasalida()
    {
        return $this->fechasalida;
    }
    /**
     * @var string
     */
    private $rutaimagen;

    /**
     * @var string
     */
    private $nombreimagen;


    /**
     * Set rutaimagen
     *
     * @param string $rutaimagen
     *
     * @return Cortesias
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
     * @return Cortesias
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
}
