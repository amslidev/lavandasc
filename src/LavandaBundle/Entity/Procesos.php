<?php

namespace LavandaBundle\Entity;

/**
 * Procesos
 */
class Procesos
{
    /**
     * @var integer
     */
    private $idproceso;

    /**
     * @var \DateTime
     */
    private $fechaproceso;

    /**
     * @var string
     */
    private $procedimiento;

    /**
     * @var string
     */
    private $productos;

    /**
     * @var string
     */
    private $comentarios;

    /**
     * @var \DateTime
     */
    private $fechaproximacita;

    /**
     * @var \LavandaBundle\Entity\Citas
     */
    private $idcita;


    /**
     * Get idproceso
     *
     * @return integer
     */
    public function getIdproceso()
    {
        return $this->idproceso;
    }

    /**
     * Set fechaproceso
     *
     * @param \DateTime $fechaproceso
     *
     * @return Procesos
     */
    public function setFechaproceso($fechaproceso)
    {
        $this->fechaproceso = $fechaproceso;

        return $this;
    }

    /**
     * Get fechaproceso
     *
     * @return \DateTime
     */
    public function getFechaproceso()
    {
        return $this->fechaproceso;
    }

    /**
     * Set procedimiento
     *
     * @param string $procedimiento
     *
     * @return Procesos
     */
    public function setProcedimiento($procedimiento)
    {
        $this->procedimiento = $procedimiento;

        return $this;
    }

    /**
     * Get procedimiento
     *
     * @return string
     */
    public function getProcedimiento()
    {
        return $this->procedimiento;
    }

    /**
     * Set productos
     *
     * @param string $productos
     *
     * @return Procesos
     */
    public function setProductos($productos)
    {
        $this->productos = $productos;

        return $this;
    }

    /**
     * Get productos
     *
     * @return string
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return Procesos
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set fechaproximacita
     *
     * @param \DateTime $fechaproximacita
     *
     * @return Procesos
     */
    public function setFechaproximacita($fechaproximacita)
    {
        $this->fechaproximacita = $fechaproximacita;

        return $this;
    }

    /**
     * Get fechaproximacita
     *
     * @return \DateTime
     */
    public function getFechaproximacita()
    {
        return $this->fechaproximacita;
    }

    /**
     * Set idcita
     *
     * @param \LavandaBundle\Entity\Citas $idcita
     *
     * @return Procesos
     */
    public function setIdcita(\LavandaBundle\Entity\Citas $idcita = null)
    {
        $this->idcita = $idcita;

        return $this;
    }

    /**
     * Get idcita
     *
     * @return \LavandaBundle\Entity\Citas
     */
    public function getIdcita()
    {
        return $this->idcita;
    }
    /**
     * @var string
     */
    private $rutafotoantes;

    /**
     * @var string
     */
    private $nombrefotoantes;

    /**
     * @var string
     */
    private $rutafotodesp;

    /**
     * @var string
     */
    private $nombrefotodesp;


    /**
     * Set rutafotoantes
     *
     * @param string $rutafotoantes
     *
     * @return Procesos
     */
    public function setRutafotoantes($rutafotoantes)
    {
        $this->rutafotoantes = $rutafotoantes;

        return $this;
    }

    /**
     * Get rutafotoantes
     *
     * @return string
     */
    public function getRutafotoantes()
    {
        return $this->rutafotoantes;
    }

    /**
     * Set nombrefotoantes
     *
     * @param string $nombrefotoantes
     *
     * @return Procesos
     */
    public function setNombrefotoantes($nombrefotoantes)
    {
        $this->nombrefotoantes = $nombrefotoantes;

        return $this;
    }

    /**
     * Get nombrefotoantes
     *
     * @return string
     */
    public function getNombrefotoantes()
    {
        return $this->nombrefotoantes;
    }

    /**
     * Set rutafotodesp
     *
     * @param string $rutafotodesp
     *
     * @return Procesos
     */
    public function setRutafotodesp($rutafotodesp)
    {
        $this->rutafotodesp = $rutafotodesp;

        return $this;
    }

    /**
     * Get rutafotodesp
     *
     * @return string
     */
    public function getRutafotodesp()
    {
        return $this->rutafotodesp;
    }

    /**
     * Set nombrefotodesp
     *
     * @param string $nombrefotodesp
     *
     * @return Procesos
     */
    public function setNombrefotodesp($nombrefotodesp)
    {
        $this->nombrefotodesp = $nombrefotodesp;

        return $this;
    }

    /**
     * Get nombrefotodesp
     *
     * @return string
     */
    public function getNombrefotodesp()
    {
        return $this->nombrefotodesp;
    }
}
