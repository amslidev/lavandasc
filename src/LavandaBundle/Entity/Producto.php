<?php

namespace LavandaBundle\Entity;

/**
 * Producto
 */
class Producto
{
    /**
     * @var integer
     */
    private $idproducto;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var float
     */
    private $precio;

    /**
     * @var string
     */
    private $rutaimagen;

    /**
     * @var string
     */
    private $nombreimagen;


    /**
     * Get idproducto
     *
     * @return integer
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set rutaimagen
     *
     * @param string $rutaimagen
     *
     * @return Producto
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
     * @return Producto
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
     * @var \DateTime
     */
    private $fechaalta;

    /**
     * @var \DateTime
     */
    private $fechabaja;

    /**
     * @var boolean
     */
    private $disponible;


    /**
     * Set fechaalta
     *
     * @param \DateTime $fechaalta
     *
     * @return Producto
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;

        return $this;
    }

    /**
     * Get fechaalta
     *
     * @return \DateTime
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * Set fechabaja
     *
     * @param \DateTime $fechabaja
     *
     * @return Producto
     */
    public function setFechabaja($fechabaja)
    {
        $this->fechabaja = $fechabaja;

        return $this;
    }

    /**
     * Get fechabaja
     *
     * @return \DateTime
     */
    public function getFechabaja()
    {
        return $this->fechabaja;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Producto
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean
     */
    public function getDisponible()
    {
        return $this->disponible;
    }
    /**
     * @var int|null
     */
    private $stockmin;

    /**
     * @var int|null
     */
    private $stock;

    /**
     * @var \LavandaBundle\Entity\Bodegas
     */
    private $idbodega;

    /**
     * @var \LavandaBundle\Entity\Proveedor
     */
    private $idproveedor;

    /**
     * @var \LavandaBundle\Entity\Unidadesmedida
     */
    private $idunidadmedida;


    /**
     * Set stockmin.
     *
     * @param int|null $stockmin
     *
     * @return Producto
     */
    public function setStockmin($stockmin = null)
    {
        $this->stockmin = $stockmin;

        return $this;
    }

    /**
     * Get stockmin.
     *
     * @return int|null
     */
    public function getStockmin()
    {
        return $this->stockmin;
    }

    /**
     * Set stock.
     *
     * @param int|null $stock
     *
     * @return Producto
     */
    public function setStock($stock = null)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock.
     *
     * @return int|null
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set idbodega.
     *
     * @param \LavandaBundle\Entity\Bodegas|null $idbodega
     *
     * @return Producto
     */
    public function setIdbodega(\LavandaBundle\Entity\Bodegas $idbodega = null)
    {
        $this->idbodega = $idbodega;

        return $this;
    }

    /**
     * Get idbodega.
     *
     * @return \LavandaBundle\Entity\Bodegas|null
     */
    public function getIdbodega()
    {
        return $this->idbodega;
    }

    /**
     * Set idproveedor.
     *
     * @param \LavandaBundle\Entity\Proveedor|null $idproveedor
     *
     * @return Producto
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
     * @return Producto
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
     * @var \LavandaBundle\Entity\Categorias
     */
    private $idcategoria;


    /**
     * Set idcategoria.
     *
     * @param \LavandaBundle\Entity\Categorias|null $idcategoria
     *
     * @return Producto
     */
    public function setIdcategoria(\LavandaBundle\Entity\Categorias $idcategoria = null)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get idcategoria.
     *
     * @return \LavandaBundle\Entity\Categorias|null
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }
    /**
     * @var \LavandaBundle\Entity\Unidadesmedida
     */
    private $unidadmedida;


    /**
     * Set unidadmedida.
     *
     * @param \LavandaBundle\Entity\Unidadesmedida|null $unidadmedida
     *
     * @return Producto
     */
    public function setUnidadmedida(\LavandaBundle\Entity\Unidadesmedida $unidadmedida = null)
    {
        $this->unidadmedida = $unidadmedida;

        return $this;
    }

    /**
     * Get unidadmedida.
     *
     * @return \LavandaBundle\Entity\Unidadesmedida|null
     */
    public function getUnidadmedida()
    {
        return $this->unidadmedida;
    }

    public function __toString()
    {
        return $this->nombre;
    }
    /**
     * @var bool|null
     */
    private $inventariocortesia;


    /**
     * Set inventariocortesia.
     *
     * @param bool|null $inventariocortesia
     *
     * @return Producto
     */
    public function setInventariocortesia($inventariocortesia = null)
    {
        $this->inventariocortesia = $inventariocortesia;

        return $this;
    }

    /**
     * Get inventariocortesia.
     *
     * @return bool|null
     */
    public function getInventariocortesia()
    {
        return $this->inventariocortesia;
    }
}
