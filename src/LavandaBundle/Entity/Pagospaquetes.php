<?php

namespace LavandaBundle\Entity;

/**
 * Pagospaquetes
 */
class Pagospaquetes
{
    /**
     * @var int
     */
    private $idpagopaquete;

    /**
     * @var float|null
     */
    private $cantidadabonada;

    /**
     * @var \DateTime|null
     */
    private $fechapago;

    /**
     * @var \LavandaBundle\Entity\Formaspago
     */
    private $idformapago;

    /**
     * @var \LavandaBundle\Entity\Paquetes
     */
    private $idpaquete;


    /**
     * Get idpagopaquete.
     *
     * @return int
     */
    public function getIdpagopaquete()
    {
        return $this->idpagopaquete;
    }

    /**
     * Set cantidadabonada.
     *
     * @param float|null $cantidadabonada
     *
     * @return Pagospaquetes
     */
    public function setCantidadabonada($cantidadabonada = null)
    {
        $this->cantidadabonada = $cantidadabonada;

        return $this;
    }

    /**
     * Get cantidadabonada.
     *
     * @return float|null
     */
    public function getCantidadabonada()
    {
        return $this->cantidadabonada;
    }

    /**
     * Set fechapago.
     *
     * @param \DateTime|null $fechapago
     *
     * @return Pagospaquetes
     */
    public function setFechapago($fechapago = null)
    {
        $this->fechapago = $fechapago;

        return $this;
    }

    /**
     * Get fechapago.
     *
     * @return \DateTime|null
     */
    public function getFechapago()
    {
        return $this->fechapago;
    }

    /**
     * Set idformapago.
     *
     * @param \LavandaBundle\Entity\Formaspago|null $idformapago
     *
     * @return Pagospaquetes
     */
    public function setIdformapago(\LavandaBundle\Entity\Formaspago $idformapago = null)
    {
        $this->idformapago = $idformapago;

        return $this;
    }

    /**
     * Get idformapago.
     *
     * @return \LavandaBundle\Entity\Formaspago|null
     */
    public function getIdformapago()
    {
        return $this->idformapago;
    }

    /**
     * Set idpaquete.
     *
     * @param \LavandaBundle\Entity\Paquetes|null $idpaquete
     *
     * @return Pagospaquetes
     */
    public function setIdpaquete(\LavandaBundle\Entity\Paquetes $idpaquete = null)
    {
        $this->idpaquete = $idpaquete;

        return $this;
    }

    /**
     * Get idpaquete.
     *
     * @return \LavandaBundle\Entity\Paquetes|null
     */
    public function getIdpaquete()
    {
        return $this->idpaquete;
    }
}
