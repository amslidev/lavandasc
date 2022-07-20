<?php

namespace LavandaBundle\Entity;

/**
 * Bitacoraventas
 */
class Bitacoraventas
{
    /**
     * @var int
     */
    private $idbitacoraventa;

    /**
     * @var string
     */
    private $evento;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var \LavandaBundle\Entity\Barventa
     */
    private $idbarventa;

    /**
     * @var \LavandaBundle\Entity\Usuario
     */
    private $idusuario;


    /**
     * Get idbitacoraventa.
     *
     * @return int
     */
    public function getIdbitacoraventa()
    {
        return $this->idbitacoraventa;
    }

    /**
     * Set evento.
     *
     * @param string $evento
     *
     * @return Bitacoraventas
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento.
     *
     * @return string
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set fecha.
     *
     * @param \DateTime $fecha
     *
     * @return Bitacoraventas
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set idbarventa.
     *
     * @param \LavandaBundle\Entity\Barventa|null $idbarventa
     *
     * @return Bitacoraventas
     */
    public function setIdbarventa(\LavandaBundle\Entity\Barventa $idbarventa = null)
    {
        $this->idbarventa = $idbarventa;

        return $this;
    }

    /**
     * Get idbarventa.
     *
     * @return \LavandaBundle\Entity\Barventa|null
     */
    public function getIdbarventa()
    {
        return $this->idbarventa;
    }

    /**
     * Set idusuario.
     *
     * @param \LavandaBundle\Entity\Usuario|null $idusuario
     *
     * @return Bitacoraventas
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
