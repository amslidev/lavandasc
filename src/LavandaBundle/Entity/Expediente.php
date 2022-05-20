<?php

namespace LavandaBundle\Entity;

/**
 * Expediente
 */
class Expediente
{
    /**
     * @var int
     */
    private $idexpediente;

    /**
     * @var string|null
     */
    private $rutafoto;

    /**
     * @var string|null
     */
    private $nombrefoto;

    /**
     * @var \DateTime|null
     */
    private $fecha;

    /**
     * @var \LavandaBundle\Entity\Cliente
     */
    private $idcliente;


    /**
     * Get idexpediente.
     *
     * @return int
     */
    public function getIdexpediente()
    {
        return $this->idexpediente;
    }

    /**
     * Set rutafoto.
     *
     * @param string|null $rutafoto
     *
     * @return Expediente
     */
    public function setRutafoto($rutafoto = null)
    {
        $this->rutafoto = $rutafoto;

        return $this;
    }

    /**
     * Get rutafoto.
     *
     * @return string|null
     */
    public function getRutafoto()
    {
        return $this->rutafoto;
    }

    /**
     * Set nombrefoto.
     *
     * @param string|null $nombrefoto
     *
     * @return Expediente
     */
    public function setNombrefoto($nombrefoto = null)
    {
        $this->nombrefoto = $nombrefoto;

        return $this;
    }

    /**
     * Get nombrefoto.
     *
     * @return string|null
     */
    public function getNombrefoto()
    {
        return $this->nombrefoto;
    }

    /**
     * Set fecha.
     *
     * @param \DateTime|null $fecha
     *
     * @return Expediente
     */
    public function setFecha($fecha = null)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \DateTime|null
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set idcliente.
     *
     * @param \LavandaBundle\Entity\Cliente|null $idcliente
     *
     * @return Expediente
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
}
