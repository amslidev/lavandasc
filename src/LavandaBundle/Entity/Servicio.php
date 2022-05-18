<?php

namespace LavandaBundle\Entity;

/**
 * Servicio
 */
class Servicio
{
    /**
     * @var integer
     */
    private $idservicio;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var integer
     */
    private $tiempo;

    /**
     * @var float
     */
    private $precio;


    /**
     * Get idservicio
     *
     * @return integer
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Servicio
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
     * Set tiempo
     *
     * @param integer $tiempo
     *
     * @return Servicio
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return integer
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Servicio
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
     * @var string
     */
    private $descripcion;


    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Servicio
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
     * @var boolean
     */
    private $cobraronza;


    /**
     * Set cobraronza
     *
     * @param boolean $cobraronza
     *
     * @return Servicio
     */
    public function setCobraronza($cobraronza)
    {
        $this->cobraronza = $cobraronza;

        return $this;
    }

    /**
     * Get cobraronza
     *
     * @return boolean
     */
    public function getCobraronza()
    {
        return $this->cobraronza;
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
     * @return Servicio
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
     * @return Servicio
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

    public function __toString()
    {
        return $this->nombre;
    }
    /**
     * @var boolean
     */
    private $activo;


    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Servicio
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
