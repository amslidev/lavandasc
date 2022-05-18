<?php

namespace LavandaBundle\Entity;

/**
 * Galeria
 */
class Galeria
{
    /**
     * @var integer
     */
    private $idgaleria;

    /**
     * @var string
     */
    private $rutaimagen;

    /**
     * @var string
     */
    private $nombreimagen;

    /**
     * @var \DateTime
     */
    private $fechacarga;


    /**
     * Get idgaleria
     *
     * @return integer
     */
    public function getIdgaleria()
    {
        return $this->idgaleria;
    }

    /**
     * Set rutaimagen
     *
     * @param string $rutaimagen
     *
     * @return Galeria
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
     * @return Galeria
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

    /**
     * Set fechacarga
     *
     * @param \DateTime $fechacarga
     *
     * @return Galeria
     */
    public function setFechacarga($fechacarga)
    {
        $this->fechacarga = $fechacarga;

        return $this;
    }

    /**
     * Get fechacarga
     *
     * @return \DateTime
     */
    public function getFechacarga()
    {
        return $this->fechacarga;
    }
}
