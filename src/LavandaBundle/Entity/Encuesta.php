<?php

namespace LavandaBundle\Entity;

/**
 * Encuesta
 */
class Encuesta
{
    /**
     * @var integer
     */
    private $idencuesta;

    /**
     * @var string
     */
    private $opcion1;

    /**
     * @var string
     */
    private $opcion2;

    /**
     * @var string
     */
    private $opcion3;

    /**
     * @var string
     */
    private $opcion4;

    /**
     * @var string
     */
    private $opcion5;

    /**
     * @var string
     */
    private $opcion6;

    /**
     * @var string
     */
    private $opcion7;

    /**
     * @var string
     */
    private $opcion8;

    /**
     * @var string
     */
    private $opcion9;

    /**
     * @var string
     */
    private $opcion10;

    /**
     * @var string
     */
    private $opcion11;

    /**
     * @var \DateTime
     */
    private $fecharegistro;

    /**
     * @var \LavandaBundle\Entity\Cliente
     */
    private $idcliente;


    /**
     * Get idencuesta
     *
     * @return integer
     */
    public function getIdencuesta()
    {
        return $this->idencuesta;
    }

    /**
     * Set opcion1
     *
     * @param string $opcion1
     *
     * @return Encuesta
     */
    public function setOpcion1($opcion1)
    {
        $this->opcion1 = $opcion1;

        return $this;
    }

    /**
     * Get opcion1
     *
     * @return string
     */
    public function getOpcion1()
    {
        return $this->opcion1;
    }

    /**
     * Set opcion2
     *
     * @param string $opcion2
     *
     * @return Encuesta
     */
    public function setOpcion2($opcion2)
    {
        $this->opcion2 = $opcion2;

        return $this;
    }

    /**
     * Get opcion2
     *
     * @return string
     */
    public function getOpcion2()
    {
        return $this->opcion2;
    }

    /**
     * Set opcion3
     *
     * @param string $opcion3
     *
     * @return Encuesta
     */
    public function setOpcion3($opcion3)
    {
        $this->opcion3 = $opcion3;

        return $this;
    }

    /**
     * Get opcion3
     *
     * @return string
     */
    public function getOpcion3()
    {
        return $this->opcion3;
    }

    /**
     * Set opcion4
     *
     * @param string $opcion4
     *
     * @return Encuesta
     */
    public function setOpcion4($opcion4)
    {
        $this->opcion4 = $opcion4;

        return $this;
    }

    /**
     * Get opcion4
     *
     * @return string
     */
    public function getOpcion4()
    {
        return $this->opcion4;
    }

    /**
     * Set opcion5
     *
     * @param string $opcion5
     *
     * @return Encuesta
     */
    public function setOpcion5($opcion5)
    {
        $this->opcion5 = $opcion5;

        return $this;
    }

    /**
     * Get opcion5
     *
     * @return string
     */
    public function getOpcion5()
    {
        return $this->opcion5;
    }

    /**
     * Set opcion6
     *
     * @param string $opcion6
     *
     * @return Encuesta
     */
    public function setOpcion6($opcion6)
    {
        $this->opcion6 = $opcion6;

        return $this;
    }

    /**
     * Get opcion6
     *
     * @return string
     */
    public function getOpcion6()
    {
        return $this->opcion6;
    }

    /**
     * Set opcion7
     *
     * @param string $opcion7
     *
     * @return Encuesta
     */
    public function setOpcion7($opcion7)
    {
        $this->opcion7 = $opcion7;

        return $this;
    }

    /**
     * Get opcion7
     *
     * @return string
     */
    public function getOpcion7()
    {
        return $this->opcion7;
    }

    /**
     * Set opcion8
     *
     * @param string $opcion8
     *
     * @return Encuesta
     */
    public function setOpcion8($opcion8)
    {
        $this->opcion8 = $opcion8;

        return $this;
    }

    /**
     * Get opcion8
     *
     * @return string
     */
    public function getOpcion8()
    {
        return $this->opcion8;
    }

    /**
     * Set opcion9
     *
     * @param string $opcion9
     *
     * @return Encuesta
     */
    public function setOpcion9($opcion9)
    {
        $this->opcion9 = $opcion9;

        return $this;
    }

    /**
     * Get opcion9
     *
     * @return string
     */
    public function getOpcion9()
    {
        return $this->opcion9;
    }

    /**
     * Set opcion10
     *
     * @param string $opcion10
     *
     * @return Encuesta
     */
    public function setOpcion10($opcion10)
    {
        $this->opcion10 = $opcion10;

        return $this;
    }

    /**
     * Get opcion10
     *
     * @return string
     */
    public function getOpcion10()
    {
        return $this->opcion10;
    }

    /**
     * Set opcion11
     *
     * @param string $opcion11
     *
     * @return Encuesta
     */
    public function setOpcion11($opcion11)
    {
        $this->opcion11 = $opcion11;

        return $this;
    }

    /**
     * Get opcion11
     *
     * @return string
     */
    public function getOpcion11()
    {
        return $this->opcion11;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     *
     * @return Encuesta
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
     * Set idcliente
     *
     * @param \LavandaBundle\Entity\Cliente $idcliente
     *
     * @return Encuesta
     */
    public function setIdcliente(\LavandaBundle\Entity\Cliente $idcliente = null)
    {
        $this->idcliente = $idcliente;

        return $this;
    }

    /**
     * Get idcliente
     *
     * @return \LavandaBundle\Entity\Cliente
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }
}
