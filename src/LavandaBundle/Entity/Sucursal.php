<?php

namespace LavandaBundle\Entity;

/**
 * Sucursal
 */
class Sucursal
{
    /**
     * @var integer
     */
    private $idsucursal;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var boolean
     */
    private $activo;


    /**
     * Get idsucursal
     *
     * @return integer
     */
    public function getIdsucursal()
    {
        return $this->idsucursal;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Sucursal
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Sucursal
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Sucursal
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

    public function __toString()
    {
        return $this->nombre;
    }
    /**
     * @var string
     */
    private $email;


    /**
     * Set email
     *
     * @param string $email
     *
     * @return Sucursal
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @var string
     */
    private $clave;


    /**
     * Set clave.
     *
     * @param string $clave
     *
     * @return Sucursal
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave.
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }
}
