<?php

namespace LavandaBundle\Entity;

/**
 * Notificaciones
 */
class Notificaciones
{
    /**
     * @var integer
     */
    private $idnotificacion;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $mensaje;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var \LavandaBundle\Entity\Usuario
     */
    private $idusuario;


    /**
     * Get idnotificacion
     *
     * @return integer
     */
    public function getIdnotificacion()
    {
        return $this->idnotificacion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Notificaciones
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     *
     * @return Notificaciones
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Notificaciones
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set idusuario
     *
     * @param \LavandaBundle\Entity\Usuario $idusuario
     *
     * @return Notificaciones
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
