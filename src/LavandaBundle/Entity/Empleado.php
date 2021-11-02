<?php

namespace LavandaBundle\Entity;

/**
 * Empleado
 */
class Empleado
{
    /**
     * @var integer
     */
    private $idempleado;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $rfc;

    /**
     * @var string
     */
    private $curp;

    /**
     * @var \DateTime
     */
    private $fecharegistro;

    /**
     * @var \DateTime
     */
    private $fechabaja;

    /**
     * @var \LavandaBundle\Entity\Usuario
     */
    private $idusuario;


    /**
     * Get idempleado
     *
     * @return integer
     */
    public function getIdempleado()
    {
        return $this->idempleado;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Empleado
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Empleado
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Empleado
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Empleado
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set rfc
     *
     * @param string $rfc
     *
     * @return Empleado
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;

        return $this;
    }

    /**
     * Get rfc
     *
     * @return string
     */
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * Set curp
     *
     * @param string $curp
     *
     * @return Empleado
     */
    public function setCurp($curp)
    {
        $this->curp = $curp;

        return $this;
    }

    /**
     * Get curp
     *
     * @return string
     */
    public function getCurp()
    {
        return $this->curp;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     *
     * @return Empleado
     */
    public function setFecharegistro($fecharegistro)
    {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    /**
     * Get fecharegistro
     *
     * @return \DateTime
     */
    public function getFecharegistro()
    {
        return $this->fecharegistro;
    }

    /**
     * Set fechabaja
     *
     * @param \DateTime $fechabaja
     *
     * @return Empleado
     */
    public function setFechabaja($fechabaja)
    {
        $this->fechabaja = $fechabaja;

        return $this;
    }

    /**
     * Get fechabaja
     *
     * @return \DateTime
     */
    public function getFechabaja()
    {
        return $this->fechabaja;
    }

    /**
     * Set idusuario
     *
     * @param \LavandaBundle\Entity\Usuario $idusuario
     *
     * @return Empleado
     */
    public function setIdusuario(\LavandaBundle\Entity\Usuario $idusuario = null)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \LavandaBundle\Entity\Usuario
     */
    public function getIdusuario()
    {
        return $this->idusuario;
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
     * @return Empleado
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
     * @return Empleado
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
     * @return Empleado
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
     * @var \LavandaBundle\Entity\Sucursal
     */
    private $idsucursal;


    /**
     * Set idsucursal
     *
     * @param \LavandaBundle\Entity\Sucursal $idsucursal
     *
     * @return Empleado
     */
    public function setIdsucursal(\LavandaBundle\Entity\Sucursal $idsucursal = null)
    {
        $this->idsucursal = $idsucursal;

        return $this;
    }

    /**
     * Get idsucursal
     *
     * @return \LavandaBundle\Entity\Sucursal
     */
    public function getIdsucursal()
    {
        return $this->idsucursal;
    }


}
