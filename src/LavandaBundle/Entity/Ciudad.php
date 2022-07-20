<?php

namespace LavandaBundle\Entity;

/**
 * Ciudad
 */
class Ciudad
{
    /**
     * @var int
     */
    private $ciudadid;

    /**
     * @var string
     */
    private $ciudadnombre = '';

    /**
     * @var string
     */
    private $ciudaddistrito = '';

    /**
     * @var int
     */
    private $ciudadpoblacion = '0';

    /**
     * @var \LavandaBundle\Entity\Pais
     */
    private $paiscodigo;


    /**
     * Get ciudadid.
     *
     * @return int
     */
    public function getCiudadid()
    {
        return $this->ciudadid;
    }

    /**
     * Set ciudadnombre.
     *
     * @param string $ciudadnombre
     *
     * @return Ciudad
     */
    public function setCiudadnombre($ciudadnombre)
    {
        $this->ciudadnombre = $ciudadnombre;

        return $this;
    }

    /**
     * Get ciudadnombre.
     *
     * @return string
     */
    public function getCiudadnombre()
    {
        return $this->ciudadnombre;
    }

    /**
     * Set ciudaddistrito.
     *
     * @param string $ciudaddistrito
     *
     * @return Ciudad
     */
    public function setCiudaddistrito($ciudaddistrito)
    {
        $this->ciudaddistrito = $ciudaddistrito;

        return $this;
    }

    /**
     * Get ciudaddistrito.
     *
     * @return string
     */
    public function getCiudaddistrito()
    {
        return $this->ciudaddistrito;
    }

    /**
     * Set ciudadpoblacion.
     *
     * @param int $ciudadpoblacion
     *
     * @return Ciudad
     */
    public function setCiudadpoblacion($ciudadpoblacion)
    {
        $this->ciudadpoblacion = $ciudadpoblacion;

        return $this;
    }

    /**
     * Get ciudadpoblacion.
     *
     * @return int
     */
    public function getCiudadpoblacion()
    {
        return $this->ciudadpoblacion;
    }

    /**
     * Set paiscodigo.
     *
     * @param \LavandaBundle\Entity\Pais|null $paiscodigo
     *
     * @return Ciudad
     */
    public function setPaiscodigo(\LavandaBundle\Entity\Pais $paiscodigo = null)
    {
        $this->paiscodigo = $paiscodigo;

        return $this;
    }

    /**
     * Get paiscodigo.
     *
     * @return \LavandaBundle\Entity\Pais|null
     */
    public function getPaiscodigo()
    {
        return $this->paiscodigo;
    }
}
