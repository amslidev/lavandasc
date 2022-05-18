<?php

namespace LavandaBundle\Entity;

/**
 * Moviles
 */
class Moviles
{
    /**
     * @var integer
     */
    private $idmovil;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \DateTime
     */
    private $fecharegistro;

    /**
     * @var \LavandaBundle\Entity\Usuario
     */
    private $idusuario;


    /**
     * Get idmovil
     *
     * @return integer
     */
    public function getIdmovil()
    {
        return $this->idmovil;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Moviles
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     *
     * @return Moviles
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
     * Set idusuario
     *
     * @param \LavandaBundle\Entity\Usuario $idusuario
     *
     * @return Moviles
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
