<?php

namespace LavandaBundle\Entity;

/**
 * Expedientecliente
 */
class Expedientecliente
{
    /**
     * @var integer
     */
    private $idexpediente;

    /**
     * @var integer
     */
    private $idcliente;

    /**
     * @var boolean
     */
    private $decoloracion;

    /**
     * @var integer
     */
    private $cantidaddecoloracion;

    /**
     * @var boolean
     */
    private $planchadopermanente;

    /**
     * @var integer
     */
    private $cantidadplanchado;

    /**
     * @var boolean
     */
    private $tintes;

    /**
     * @var integer
     */
    private $cantidadtintes;

    /**
     * @var boolean
     */
    private $alisadosprogresivos;

    /**
     * @var integer
     */
    private $cantidadalisados;

    /**
     * @var boolean
     */
    private $caspa;

    /**
     * @var boolean
     */
    private $alergiacosmetico;

    /**
     * @var string
     */
    private $nombrecosmetico;

    /**
     * @var boolean
     */
    private $alergiaquimico;

    /**
     * @var string
     */
    private $nombrequimico;

    /**
     * @var boolean
     */
    private $productosacidos;

    /**
     * @var string
     */
    private $nombreproductoacido;

    /**
     * @var boolean
     */
    private $usomedicamentos;

    /**
     * @var string
     */
    private $nombremedicamentos;

    /**
     * @var boolean
     */
    private $embarazada;

    /**
     * @var \LavandaBundle\Entity\Diagnostico
     */
    private $iddiagnostico;

    /**
     * @var \LavandaBundle\Entity\Tipocuero
     */
    private $idtipocuero;


    /**
     * Get idexpediente
     *
     * @return integer
     */
    public function getIdexpediente()
    {
        return $this->idexpediente;
    }

    /**
     * Set idcliente
     *
     * @param integer $idcliente
     *
     * @return Expedientecliente
     */
    public function setIdcliente($idcliente)
    {
        $this->idcliente = $idcliente;

        return $this;
    }

    /**
     * Get idcliente
     *
     * @return integer
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    /**
     * Set decoloracion
     *
     * @param boolean $decoloracion
     *
     * @return Expedientecliente
     */
    public function setDecoloracion($decoloracion)
    {
        $this->decoloracion = $decoloracion;

        return $this;
    }

    /**
     * Get decoloracion
     *
     * @return boolean
     */
    public function getDecoloracion()
    {
        return $this->decoloracion;
    }

    /**
     * Set cantidaddecoloracion
     *
     * @param integer $cantidaddecoloracion
     *
     * @return Expedientecliente
     */
    public function setCantidaddecoloracion($cantidaddecoloracion)
    {
        $this->cantidaddecoloracion = $cantidaddecoloracion;

        return $this;
    }

    /**
     * Get cantidaddecoloracion
     *
     * @return integer
     */
    public function getCantidaddecoloracion()
    {
        return $this->cantidaddecoloracion;
    }

    /**
     * Set planchadopermanente
     *
     * @param boolean $planchadopermanente
     *
     * @return Expedientecliente
     */
    public function setPlanchadopermanente($planchadopermanente)
    {
        $this->planchadopermanente = $planchadopermanente;

        return $this;
    }

    /**
     * Get planchadopermanente
     *
     * @return boolean
     */
    public function getPlanchadopermanente()
    {
        return $this->planchadopermanente;
    }

    /**
     * Set cantidadplanchado
     *
     * @param integer $cantidadplanchado
     *
     * @return Expedientecliente
     */
    public function setCantidadplanchado($cantidadplanchado)
    {
        $this->cantidadplanchado = $cantidadplanchado;

        return $this;
    }

    /**
     * Get cantidadplanchado
     *
     * @return integer
     */
    public function getCantidadplanchado()
    {
        return $this->cantidadplanchado;
    }

    /**
     * Set tintes
     *
     * @param boolean $tintes
     *
     * @return Expedientecliente
     */
    public function setTintes($tintes)
    {
        $this->tintes = $tintes;

        return $this;
    }

    /**
     * Get tintes
     *
     * @return boolean
     */
    public function getTintes()
    {
        return $this->tintes;
    }

    /**
     * Set cantidadtintes
     *
     * @param integer $cantidadtintes
     *
     * @return Expedientecliente
     */
    public function setCantidadtintes($cantidadtintes)
    {
        $this->cantidadtintes = $cantidadtintes;

        return $this;
    }

    /**
     * Get cantidadtintes
     *
     * @return integer
     */
    public function getCantidadtintes()
    {
        return $this->cantidadtintes;
    }

    /**
     * Set alisadosprogresivos
     *
     * @param boolean $alisadosprogresivos
     *
     * @return Expedientecliente
     */
    public function setAlisadosprogresivos($alisadosprogresivos)
    {
        $this->alisadosprogresivos = $alisadosprogresivos;

        return $this;
    }

    /**
     * Get alisadosprogresivos
     *
     * @return boolean
     */
    public function getAlisadosprogresivos()
    {
        return $this->alisadosprogresivos;
    }

    /**
     * Set cantidadalisados
     *
     * @param integer $cantidadalisados
     *
     * @return Expedientecliente
     */
    public function setCantidadalisados($cantidadalisados)
    {
        $this->cantidadalisados = $cantidadalisados;

        return $this;
    }

    /**
     * Get cantidadalisados
     *
     * @return integer
     */
    public function getCantidadalisados()
    {
        return $this->cantidadalisados;
    }

    /**
     * Set caspa
     *
     * @param boolean $caspa
     *
     * @return Expedientecliente
     */
    public function setCaspa($caspa)
    {
        $this->caspa = $caspa;

        return $this;
    }

    /**
     * Get caspa
     *
     * @return boolean
     */
    public function getCaspa()
    {
        return $this->caspa;
    }

    /**
     * Set alergiacosmetico
     *
     * @param boolean $alergiacosmetico
     *
     * @return Expedientecliente
     */
    public function setAlergiacosmetico($alergiacosmetico)
    {
        $this->alergiacosmetico = $alergiacosmetico;

        return $this;
    }

    /**
     * Get alergiacosmetico
     *
     * @return boolean
     */
    public function getAlergiacosmetico()
    {
        return $this->alergiacosmetico;
    }

    /**
     * Set nombrecosmetico
     *
     * @param string $nombrecosmetico
     *
     * @return Expedientecliente
     */
    public function setNombrecosmetico($nombrecosmetico)
    {
        $this->nombrecosmetico = $nombrecosmetico;

        return $this;
    }

    /**
     * Get nombrecosmetico
     *
     * @return string
     */
    public function getNombrecosmetico()
    {
        return $this->nombrecosmetico;
    }

    /**
     * Set alergiaquimico
     *
     * @param boolean $alergiaquimico
     *
     * @return Expedientecliente
     */
    public function setAlergiaquimico($alergiaquimico)
    {
        $this->alergiaquimico = $alergiaquimico;

        return $this;
    }

    /**
     * Get alergiaquimico
     *
     * @return boolean
     */
    public function getAlergiaquimico()
    {
        return $this->alergiaquimico;
    }

    /**
     * Set nombrequimico
     *
     * @param string $nombrequimico
     *
     * @return Expedientecliente
     */
    public function setNombrequimico($nombrequimico)
    {
        $this->nombrequimico = $nombrequimico;

        return $this;
    }

    /**
     * Get nombrequimico
     *
     * @return string
     */
    public function getNombrequimico()
    {
        return $this->nombrequimico;
    }

    /**
     * Set productosacidos
     *
     * @param boolean $productosacidos
     *
     * @return Expedientecliente
     */
    public function setProductosacidos($productosacidos)
    {
        $this->productosacidos = $productosacidos;

        return $this;
    }

    /**
     * Get productosacidos
     *
     * @return boolean
     */
    public function getProductosacidos()
    {
        return $this->productosacidos;
    }

    /**
     * Set nombreproductoacido
     *
     * @param string $nombreproductoacido
     *
     * @return Expedientecliente
     */
    public function setNombreproductoacido($nombreproductoacido)
    {
        $this->nombreproductoacido = $nombreproductoacido;

        return $this;
    }

    /**
     * Get nombreproductoacido
     *
     * @return string
     */
    public function getNombreproductoacido()
    {
        return $this->nombreproductoacido;
    }

    /**
     * Set usomedicamentos
     *
     * @param boolean $usomedicamentos
     *
     * @return Expedientecliente
     */
    public function setUsomedicamentos($usomedicamentos)
    {
        $this->usomedicamentos = $usomedicamentos;

        return $this;
    }

    /**
     * Get usomedicamentos
     *
     * @return boolean
     */
    public function getUsomedicamentos()
    {
        return $this->usomedicamentos;
    }

    /**
     * Set nombremedicamentos
     *
     * @param string $nombremedicamentos
     *
     * @return Expedientecliente
     */
    public function setNombremedicamentos($nombremedicamentos)
    {
        $this->nombremedicamentos = $nombremedicamentos;

        return $this;
    }

    /**
     * Get nombremedicamentos
     *
     * @return string
     */
    public function getNombremedicamentos()
    {
        return $this->nombremedicamentos;
    }

    /**
     * Set embarazada
     *
     * @param boolean $embarazada
     *
     * @return Expedientecliente
     */
    public function setEmbarazada($embarazada)
    {
        $this->embarazada = $embarazada;

        return $this;
    }

    /**
     * Get embarazada
     *
     * @return boolean
     */
    public function getEmbarazada()
    {
        return $this->embarazada;
    }

    /**
     * Set iddiagnostico
     *
     * @param \LavandaBundle\Entity\Diagnostico $iddiagnostico
     *
     * @return Expedientecliente
     */
    public function setIddiagnostico(\LavandaBundle\Entity\Diagnostico $iddiagnostico = null)
    {
        $this->iddiagnostico = $iddiagnostico;

        return $this;
    }

    /**
     * Get iddiagnostico
     *
     * @return \LavandaBundle\Entity\Diagnostico
     */
    public function getIddiagnostico()
    {
        return $this->iddiagnostico;
    }

    /**
     * Set idtipocuero
     *
     * @param \LavandaBundle\Entity\Tipocuero $idtipocuero
     *
     * @return Expedientecliente
     */
    public function setIdtipocuero(\LavandaBundle\Entity\Tipocuero $idtipocuero = null)
    {
        $this->idtipocuero = $idtipocuero;

        return $this;
    }

    /**
     * Get idtipocuero
     *
     * @return \LavandaBundle\Entity\Tipocuero
     */
    public function getIdtipocuero()
    {
        return $this->idtipocuero;
    }
}
