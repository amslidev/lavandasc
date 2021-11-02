<?php

namespace LavandaBundle\Entity;

/**
 * Citas
 */
class Citas
{
    /**
     * @var integer
     */
    private $idcita;

    /**
     * @var string
     */
    private $nombrecliente;

    /**
     * @var \DateTime
     */
    private $fechacita;

    /**
     * @var \DateTime
     */
    private $horarioinicio;

    /**
     * @var \DateTime
     */
    private $horariofin;

    /**
     * @var string
     */
    private $comentarios;

    /**
     * @var \LavandaBundle\Entity\Cortesias
     */
    private $idcortesia;

    /**
     * @var \LavandaBundle\Entity\Empleado
     */
    private $idempleado;

    /**
     * @var \LavandaBundle\Entity\Estatuscita
     */
    private $idestatus;

    /**
     * @var \LavandaBundle\Entity\Servicio
     */
    private $idservicio;


    /**
     * Get idcita
     *
     * @return integer
     */
    public function getIdcita()
    {
        return $this->idcita;
    }

    /**
     * Set nombrecliente
     *
     * @param string $nombrecliente
     *
     * @return Citas
     */
    public function setNombrecliente($nombrecliente)
    {
        $this->nombrecliente = $nombrecliente;

        return $this;
    }

    /**
     * Get nombrecliente
     *
     * @return string
     */
    public function getNombrecliente()
    {
        return $this->nombrecliente;
    }

    /**
     * Set fechacita
     *
     * @param \DateTime $fechacita
     *
     * @return Citas
     */
    public function setFechacita($fechacita)
    {
        $this->fechacita = $fechacita;

        return $this;
    }

    /**
     * Get fechacita
     *
     * @return \DateTime
     */
    public function getFechacita()
    {
        return $this->fechacita;
    }

    /**
     * Set horarioinicio
     *
     * @param \DateTime $horarioinicio
     *
     * @return Citas
     */
    public function setHorarioinicio($horarioinicio)
    {
        $this->horarioinicio = $horarioinicio;

        return $this;
    }

    /**
     * Get horarioinicio
     *
     * @return \DateTime
     */
    public function getHorarioinicio()
    {
        return $this->horarioinicio;
    }

    /**
     * Set horariofin
     *
     * @param \DateTime $horariofin
     *
     * @return Citas
     */
    public function setHorariofin($horariofin)
    {
        $this->horariofin = $horariofin;

        return $this;
    }

    /**
     * Get horariofin
     *
     * @return \DateTime
     */
    public function getHorariofin()
    {
        return $this->horariofin;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return Citas
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
     * Set idcortesia
     *
     * @param \LavandaBundle\Entity\Cortesias $idcortesia
     *
     * @return Citas
     */
    public function setIdcortesia(\LavandaBundle\Entity\Cortesias $idcortesia = null)
    {
        $this->idcortesia = $idcortesia;

        return $this;
    }

    /**
     * Get idcortesia
     *
     * @return \LavandaBundle\Entity\Cortesias
     */
    public function getIdcortesia()
    {
        return $this->idcortesia;
    }

    /**
     * Set idempleado
     *
     * @param \LavandaBundle\Entity\Empleado $idempleado
     *
     * @return Citas
     */
    public function setIdempleado(\LavandaBundle\Entity\Empleado $idempleado = null)
    {
        $this->idempleado = $idempleado;

        return $this;
    }

    /**
     * Get idempleado
     *
     * @return \LavandaBundle\Entity\Empleado
     */
    public function getIdempleado()
    {
        return $this->idempleado;
    }

    /**
     * Set idestatus
     *
     * @param \LavandaBundle\Entity\Estatuscita $idestatus
     *
     * @return Citas
     */
    public function setIdestatus(\LavandaBundle\Entity\Estatuscita $idestatus = null)
    {
        $this->idestatus = $idestatus;

        return $this;
    }

    /**
     * Get idestatus
     *
     * @return \LavandaBundle\Entity\Estatuscita
     */
    public function getIdestatus()
    {
        return $this->idestatus;
    }

    /**
     * Set idservicio
     *
     * @param \LavandaBundle\Entity\Servicio $idservicio
     *
     * @return Citas
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
    /**
     * @var \LavandaBundle\Entity\Cliente
     */
    private $idcliente;


    /**
     * Set idcliente
     *
     * @param \LavandaBundle\Entity\Cliente $idcliente
     *
     * @return Citas
     */
    public function setIdcliente(\LavandaBundle\Entity\Cliente $idcliente = null)
    {
        $this->idcliente = $idcliente;

        return $this;
    }

    /**
     * Get idcliente
     *
     * @return \LavandaBundle\Entity\Cliente
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }
    /**
     * @var \LavandaBundle\Entity\Serviciolongitud
     */
    private $idserviciolongitud;


    /**
     * Set idserviciolongitud
     *
     * @param \LavandaBundle\Entity\Serviciolongitud $idserviciolongitud
     *
     * @return Citas
     */
    public function setIdserviciolongitud(\LavandaBundle\Entity\Serviciolongitud $idserviciolongitud = null)
    {
        $this->idserviciolongitud = $idserviciolongitud;

        return $this;
    }

    /**
     * Get idserviciolongitud
     *
     * @return \LavandaBundle\Entity\Serviciolongitud
     */
    public function getIdserviciolongitud()
    {
        return $this->idserviciolongitud;
    }
}
