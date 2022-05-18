<?php

namespace LavandaBundle\Entity;

/**
 * Cobranza
 */
class Cobranza
{
    /**
     * @var integer
     */
    private $idcobranza;

    /**
     * @var integer
     */
    private $cantidadonza;

    /**
     * @var float
     */
    private $total;

    /**
     * @var \DateTime
     */
    private $fecharegistro;

    /**
     * @var \LavandaBundle\Entity\Citas
     */
    private $idcita;

    /**
     * @var \LavandaBundle\Entity\Usuario
     */
    private $idusuario;


    /**
     * Get idcobranza
     *
     * @return integer
     */
    public function getIdcobranza()
    {
        return $this->idcobranza;
    }

    /**
     * Set cantidadonza
     *
     * @param integer $cantidadonza
     *
     * @return Cobranza
     */
    public function setCantidadonza($cantidadonza)
    {
        $this->cantidadonza = $cantidadonza;

        return $this;
    }

    /**
     * Get cantidadonza
     *
     * @return integer
     */
    public function getCantidadonza()
    {
        return $this->cantidadonza;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Cobranza
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     *
     * @return Cobranza
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
     * Set idcita
     *
     * @param \LavandaBundle\Entity\Citas $idcita
     *
     * @return Cobranza
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
     * Set idusuario
     *
     * @param \LavandaBundle\Entity\Usuario $idusuario
     *
     * @return Cobranza
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
}
