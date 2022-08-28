<?php

namespace LavandaBundle\Entity;

/**
 * Logs
 */
class Logs
{
    /**
     * @var int
     */
    private $idlogs;

    /**
     * @var string|null
     */
    private $modulo;

    /**
     * @var string|null
     */
    private $evento;

    /**
     * @var \DateTime|null
     */
    private $fecha;

    /**
     * @var \LavandaBundle\Entity\Usuario
     */
    private $idusuario;


    /**
     * Get idlogs.
     *
     * @return int
     */
    public function getIdlogs()
    {
        return $this->idlogs;
    }

    /**
     * Set modulo.
     *
     * @param string|null $modulo
     *
     * @return Logs
     */
    public function setModulo($modulo = null)
    {
        $this->modulo = $modulo;

        return $this;
    }

    /**
     * Get modulo.
     *
     * @return string|null
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Set evento.
     *
     * @param string|null $evento
     *
     * @return Logs
     */
    public function setEvento($evento = null)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento.
     *
     * @return string|null
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set fecha.
     *
     * @param \DateTime|null $fecha
     *
     * @return Logs
     */
    public function setFecha($fecha = null)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \DateTime|null
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set idusuario.
     *
     * @param \LavandaBundle\Entity\Usuario|null $idusuario
     *
     * @return Logs
     */
    public function setIdusuario(\LavandaBundle\Entity\Usuario $idusuario = null)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario.
     *
     * @return \LavandaBundle\Entity\Usuario|null
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}
