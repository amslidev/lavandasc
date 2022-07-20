<?php

namespace LavandaBundle\Entity;

/**
 * Comprasproducto
 */
class Comprasproducto
{
    /**
     * @var int
     */
    private $idcomprasproducto;

    /**
     * @var int
     */
    private $cantidad;

    /**
     * @var float
     */
    private $precio;

    /**
     * @var \LavandaBundle\Entity\Producto
     */
    private $idproducto;

    /**
     * @var \LavandaBundle\Entity\Proveedor
     */
    private $idproveedor;

    /**
     * @var \LavandaBundle\Entity\Unidadesmedida
     */
    private $idunidadmedida;


    /**
     * Get idcomprasproducto.
     *
     * @return int
     */
    public function getIdcomprasproducto()
    {
        return $this->idcomprasproducto;
    }

    /**
     * Set cantidad.
     *
     * @param int $cantidad
     *
     * @return Comprasproducto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad.
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set precio.
     *
     * @param float $precio
     *
     * @return Comprasproducto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio.
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set idproducto.
     *
     * @param \LavandaBundle\Entity\Producto|null $idproducto
     *
     * @return Comprasproducto
     */
    public function setIdproducto(\LavandaBundle\Entity\Producto $idproducto = null)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto.
     *
     * @return \LavandaBundle\Entity\Producto|null
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set idproveedor.
     *
     * @param \LavandaBundle\Entity\Proveedor|null $idproveedor
     *
     * @return Comprasproducto
     */
    public function setIdproveedor(\LavandaBundle\Entity\Proveedor $idproveedor = null)
    {
        $this->idproveedor = $idproveedor;

        return $this;
    }

    /**
     * Get idproveedor.
     *
     * @return \LavandaBundle\Entity\Proveedor|null
     */
    public function getIdproveedor()
    {
        return $this->idproveedor;
    }

    /**
     * Set idunidadmedida.
     *
     * @param \LavandaBundle\Entity\Unidadesmedida|null $idunidadmedida
     *
     * @return Comprasproducto
     */
    public function setIdunidadmedida(\LavandaBundle\Entity\Unidadesmedida $idunidadmedida = null)
    {
        $this->idunidadmedida = $idunidadmedida;

        return $this;
    }

    /**
     * Get idunidadmedida.
     *
     * @return \LavandaBundle\Entity\Unidadesmedida|null
     */
    public function getIdunidadmedida()
    {
        return $this->idunidadmedida;
    }
    /**
     * @var \DateTime|null
     */
    private $fecha;


    /**
     * Set fecha.
     *
     * @param \DateTime|null $fecha
     *
     * @return Comprasproducto
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
     * @var string|null
     */
    private $rutaarchivo;

    /**
     * @var string|null
     */
    private $nombrearchivo;


    /**
     * Set rutaarchivo.
     *
     * @param string|null $rutaarchivo
     *
     * @return Comprasproducto
     */
    public function setRutaarchivo($rutaarchivo = null)
    {
        $this->rutaarchivo = $rutaarchivo;

        return $this;
    }

    /**
     * Get rutaarchivo.
     *
     * @return string|null
     */
    public function getRutaarchivo()
    {
        return $this->rutaarchivo;
    }

    /**
     * Set nombrearchivo.
     *
     * @param string|null $nombrearchivo
     *
     * @return Comprasproducto
     */
    public function setNombrearchivo($nombrearchivo = null)
    {
        $this->nombrearchivo = $nombrearchivo;

        return $this;
    }

    /**
     * Get nombrearchivo.
     *
     * @return string|null
     */
    public function getNombrearchivo()
    {
        return $this->nombrearchivo;
    }
    /**
     * @var string|null
     */
    private $rutaxml;

    /**
     * @var string|null
     */
    private $nombrexml;


    /**
     * Set rutaxml.
     *
     * @param string|null $rutaxml
     *
     * @return Comprasproducto
     */
    public function setRutaxml($rutaxml = null)
    {
        $this->rutaxml = $rutaxml;

        return $this;
    }

    /**
     * Get rutaxml.
     *
     * @return string|null
     */
    public function getRutaxml()
    {
        return $this->rutaxml;
    }

    /**
     * Set nombrexml.
     *
     * @param string|null $nombrexml
     *
     * @return Comprasproducto
     */
    public function setNombrexml($nombrexml = null)
    {
        $this->nombrexml = $nombrexml;

        return $this;
    }

    /**
     * Get nombrexml.
     *
     * @return string|null
     */
    public function getNombrexml()
    {
        return $this->nombrexml;
    }
}
