<?php

namespace LavandaBundle\Entity;

/**
 * Globales
 */
class Globales
{
    /**
     * @var integer
     */
    private $idglobal;

    /**
     * @var string
     */
    private $concepto;

    /**
     * @var string
     */
    private $clave;

    /**
     * @var string
     */
    private $valor;


    /**
     * Get idglobal
     *
     * @return integer
     */
    public function getIdglobal()
    {
        return $this->idglobal;
    }

    /**
     * Set concepto
     *
     * @param string $concepto
     *
     * @return Globales
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return string
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set clave
     *
     * @param string $clave
     *
     * @return Globales
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Globales
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }
}
