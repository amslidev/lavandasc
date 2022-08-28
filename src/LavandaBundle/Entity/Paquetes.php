<?php

namespace LavandaBundle\Entity;

/**
 * Paquetes
 */
class Paquetes
{
    /**
     * @var int
     */
    private $idpaquete;

    /**
     * @var int
     */
    private $cantidad;

    /**
     * @var float|null
     */
    private $precio;

    /**
     * @var \LavandaBundle\Entity\Cliente
     */
    private $idcliente;

    /**
     * @var \LavandaBundle\Entity\Servicio
     */
    private $idservicio;


    /**
     * Get idpaquete.
     *
     * @return int
     */
    public function getIdpaquete()
    {
        return $this->idpaquete;
    }

    /**
     * Set cantidad.
     *
     * @param int $cantidad
     *
     * @return Paquetes
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad.
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set precio.
     *
     * @param float|null $precio
     *
     * @return Paquetes
     */
    public function setPrecio($precio = null)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio.
     *
     * @return float|null
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set idcliente.
     *
     * @param \LavandaBundle\Entity\Cliente|null $idcliente
     *
     * @return Paquetes
     */
    public function setIdcliente(\LavandaBundle\Entity\Cliente $idcliente = null)
    {
        $this->idcliente = $idcliente;

        return $this;
    }

    /**
     * Get idcliente.
     *
     * @return \LavandaBundle\Entity\Cliente|null
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    /**
     * Set idservicio.
     *
     * @param \LavandaBundle\Entity\Servicio|null $idservicio
     *
     * @return Paquetes
     */
    public function setIdservicio(\LavandaBundle\Entity\Servicio $idservicio = null)
    {
        $this->idservicio = $idservicio;

        return $this;
    }

    /**
     * Get idservicio.
     *
     * @return \LavandaBundle\Entity\Servicio|null
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }
    /**
     * @var \DateTime|null
     */
    private $fechainicio;

    /**
     * @var \DateTime|null
     */
    private $fechafin;


    /**
     * Set fechainicio.
     *
     * @param \DateTime|null $fechainicio
     *
     * @return Paquetes
     */
    public function setFechainicio($fechainicio = null)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio.
     *
     * @return \DateTime|null
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechafin.
     *
     * @param \DateTime|null $fechafin
     *
     * @return Paquetes
     */
    public function setFechafin($fechafin = null)
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    /**
     * Get fechafin.
     *
     * @return \DateTime|null
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }
}
