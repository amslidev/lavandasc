<?php

namespace LavandaBundle\Entity;

/**
 * Empresa
 */
class Empresa
{
    /**
     * @var integer
     */
    private $idempresa;

    /**
     * @var string
     */
    private $razonsocial;

    /**
     * @var string
     */
    private $direccionfiscal;

    /**
     * @var string
     */
    private $representante;

    /**
     * @var string
     */
    private $telefonorepresentante;

    /**
     * @var string
     */
    private $rfc;

    /**
     * @var string
     */
    private $rutalogo;

    /**
     * @var string
     */
    private $nombrelogo;

    /**
     * @var string
     */
    private $mision;

    /**
     * @var string
     */
    private $vision;

    /**
     * @var string
     */
    private $valores;


    /**
     * Get idempresa
     *
     * @return integer
     */
    public function getIdempresa()
    {
        return $this->idempresa;
    }

    /**
     * Set razonsocial
     *
     * @param string $razonsocial
     *
     * @return Empresa
     */
    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;

        return $this;
    }

    /**
     * Get razonsocial
     *
     * @return string
     */
    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    /**
     * Set direccionfiscal
     *
     * @param string $direccionfiscal
     *
     * @return Empresa
     */
    public function setDireccionfiscal($direccionfiscal)
    {
        $this->direccionfiscal = $direccionfiscal;

        return $this;
    }

    /**
     * Get direccionfiscal
     *
     * @return string
     */
    public function getDireccionfiscal()
    {
        return $this->direccionfiscal;
    }

    /**
     * Set representante
     *
     * @param string $representante
     *
     * @return Empresa
     */
    public function setRepresentante($representante)
    {
        $this->representante = $representante;

        return $this;
    }

    /**
     * Get representante
     *
     * @return string
     */
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Set telefonorepresentante
     *
     * @param string $telefonorepresentante
     *
     * @return Empresa
     */
    public function setTelefonorepresentante($telefonorepresentante)
    {
        $this->telefonorepresentante = $telefonorepresentante;

        return $this;
    }

    /**
     * Get telefonorepresentante
     *
     * @return string
     */
    public function getTelefonorepresentante()
    {
        return $this->telefonorepresentante;
    }

    /**
     * Set rfc
     *
     * @param string $rfc
     *
     * @return Empresa
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
     * Set rutalogo
     *
     * @param string $rutalogo
     *
     * @return Empresa
     */
    public function setRutalogo($rutalogo)
    {
        $this->rutalogo = $rutalogo;

        return $this;
    }

    /**
     * Get rutalogo
     *
     * @return string
     */
    public function getRutalogo()
    {
        return $this->rutalogo;
    }

    /**
     * Set nombrelogo
     *
     * @param string $nombrelogo
     *
     * @return Empresa
     */
    public function setNombrelogo($nombrelogo)
    {
        $this->nombrelogo = $nombrelogo;

        return $this;
    }

    /**
     * Get nombrelogo
     *
     * @return string
     */
    public function getNombrelogo()
    {
        return $this->nombrelogo;
    }

    /**
     * Set mision
     *
     * @param string $mision
     *
     * @return Empresa
     */
    public function setMision($mision)
    {
        $this->mision = $mision;

        return $this;
    }

    /**
     * Get mision
     *
     * @return string
     */
    public function getMision()
    {
        return $this->mision;
    }

    /**
     * Set vision
     *
     * @param string $vision
     *
     * @return Empresa
     */
    public function setVision($vision)
    {
        $this->vision = $vision;

        return $this;
    }

    /**
     * Get vision
     *
     * @return string
     */
    public function getVision()
    {
        return $this->vision;
    }

    /**
     * Set valores
     *
     * @param string $valores
     *
     * @return Empresa
     */
    public function setValores($valores)
    {
        $this->valores = $valores;

        return $this;
    }

    /**
     * Get valores
     *
     * @return string
     */
    public function getValores()
    {
        return $this->valores;
    }
}
