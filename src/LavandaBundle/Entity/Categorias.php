<?php

namespace LavandaBundle\Entity;

/**
 * Categorias
 */
class Categorias
{
    /**
     * @var int
     */
    private $idcategorias;

    /**
     * @var string|null
     */
    private $nombre;

    /**
     * @var string|null
     */
    private $descripcion;


    /**
     * Get idcategorias.
     *
     * @return int
     */
    public function getIdcategorias()
    {
        return $this->idcategorias;
    }

    /**
     * Set nombre.
     *
     * @param string|null $nombre
     *
     * @return Categorias
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
     * Set descripcion.
     *
     * @param string|null $descripcion
     *
     * @return Categorias
     */
    public function setDescripcion($descripcion = null)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion.
     *
     * @return string|null
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
