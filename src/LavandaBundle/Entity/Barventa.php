<?php

namespace LavandaBundle\Entity;

/**
 * Barventa
 */
class Barventa
{
    /**
     * @var int
     */
    private $idbarventa;

    /**
     * @var float|null
     */
    private $total;

    /**
     * @var \DateTime|null
     */
    private $fecha;

    /**
     * @var \LavandaBundle\Entity\Cliente
     */
    private $idcliente;

    /**
     * @var \LavandaBundle\Entity\Estatusventa
     */
    private $idestatus;

    /**
     * @var \LavandaBundle\Entity\Formaspago
     */
    private $idformapago;

    /**
     * @var \LavandaBundle\Entity\Sucursal
     */
    private $idsucursal;

    /**
     * @var \LavandaBundle\Entity\Usuario
     */
    private $idusuario;


    /**
     * Get idbarventa.
     *
     * @return int
     */
    public function getIdbarventa()
    {
        return $this->idbarventa;
    }

    /**
     * Set total.
     *
     * @param float|null $total
     *
     * @return Barventa
     */
    public function setTotal($total = null)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total.
     *
     * @return float|null
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set fecha.
     *
     * @param \DateTime|null $fecha
     *
     * @return Barventa
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
     * Set idcliente.
     *
     * @param \LavandaBundle\Entity\Cliente|null $idcliente
     *
     * @return Barventa
     */
    public function setIdcliente(\LavandaBundle\Entity\Cliente $idcliente = null)
    {
        $this->idcliente = $idcliente;

        return $this;
    }

    /**
     * Get idcliente.
     *
     * @return \LavandaBundle\Entity\Cliente|null
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    /**
     * Set idestatus.
     *
     * @param \LavandaBundle\Entity\Estatusventa|null $idestatus
     *
     * @return Barventa
     */
    public function setIdestatus(\LavandaBundle\Entity\Estatusventa $idestatus = null)
    {
        $this->idestatus = $idestatus;

        return $this;
    }

    /**
     * Get idestatus.
     *
     * @return \LavandaBundle\Entity\Estatusventa|null
     */
    public function getIdestatus()
    {
        return $this->idestatus;
    }

    /**
     * Set idformapago.
     *
     * @param \LavandaBundle\Entity\Formaspago|null $idformapago
     *
     * @return Barventa
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
     * Set idsucursal.
     *
     * @param \LavandaBundle\Entity\Sucursal|null $idsucursal
     *
     * @return Barventa
     */
    public function setIdsucursal(\LavandaBundle\Entity\Sucursal $idsucursal = null)
    {
        $this->idsucursal = $idsucursal;

        return $this;
    }

    /**
     * Get idsucursal.
     *
     * @return \LavandaBundle\Entity\Sucursal|null
     */
    public function getIdsucursal()
    {
        return $this->idsucursal;
    }

    /**
     * Set idusuario.
     *
     * @param \LavandaBundle\Entity\Usuario|null $idusuario
     *
     * @return Barventa
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
    /**
     * @var string
     */
    private $noorden;


    /**
     * Set noorden.
     *
     * @param string $noorden
     *
     * @return Barventa
     */
    public function setNoorden($noorden)
    {
        $this->noorden = $noorden;

        return $this;
    }

    /**
     * Get noorden.
     *
     * @return string
     */
    public function getNoorden()
    {
        return $this->noorden;
    }
    /**
     * @var int|null
     */
    private $descuento;


    /**
     * Set descuento.
     *
     * @param int|null $descuento
     *
     * @return Barventa
     */
    public function setDescuento($descuento = null)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento.
     *
     * @return int|null
     */
    public function getDescuento()
    {
        return $this->descuento;
    }
}
