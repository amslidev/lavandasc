<?php

namespace LavandaBundle\Entity;

/**
 * Detallepaquete
 */
class Detallepaquete
{
    /**
     * @var int
     */
    private $iddetallepaquete;

    /**
     * @var \DateTime|null
     */
    private $fechaaplicacion;

    /**
     * @var \LavandaBundle\Entity\Paquetes
     */
    private $idpaquete;


    /**
     * Get iddetallepaquete.
     *
     * @return int
     */
    public function getIddetallepaquete()
    {
        return $this->iddetallepaquete;
    }

    /**
     * Set fechaaplicacion.
     *
     * @param \DateTime|null $fechaaplicacion
     *
     * @return Detallepaquete
     */
    public function setFechaaplicacion($fechaaplicacion = null)
    {
        $this->fechaaplicacion = $fechaaplicacion;

        return $this;
    }

    /**
     * Get fechaaplicacion.
     *
     * @return \DateTime|null
     */
    public function getFechaaplicacion()
    {
        return $this->fechaaplicacion;
    }

    /**
     * Set idpaquete.
     *
     * @param \LavandaBundle\Entity\Paquetes|null $idpaquete
     *
     * @return Detallepaquete
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
