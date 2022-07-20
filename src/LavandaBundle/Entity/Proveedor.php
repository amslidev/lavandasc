<?php

namespace LavandaBundle\Entity;

/**
 * Proveedor
 */
class Proveedor
{
    /**
     * @var int
     */
    private $idproveedor;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string|null
     */
    private $direccion;

    /**
     * @var string|null
     */
    private $noint;

    /**
     * @var string|null
     */
    private $noext;

    /**
     * @var string
     */
    private $rfc;

    /**
     * @var string|null
     */
    private $contacto;

    /**
     * @var string|null
     */
    private $telefono;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var \LavandaBundle\Entity\Ciudad
     */
    private $idciudad;


    /**
     * Get idproveedor.
     *
     * @return int
     */
    public function getIdproveedor()
    {
        return $this->idproveedor;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Proveedor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set direccion.
     *
     * @param string|null $direccion
     *
     * @return Proveedor
     */
    public function setDireccion($direccion = null)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion.
     *
     * @return string|null
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set noint.
     *
     * @param string|null $noint
     *
     * @return Proveedor
     */
    public function setNoint($noint = null)
    {
        $this->noint = $noint;

        return $this;
    }

    /**
     * Get noint.
     *
     * @return string|null
     */
    public function getNoint()
    {
        return $this->noint;
    }

    /**
     * Set noext.
     *
     * @param string|null $noext
     *
     * @return Proveedor
     */
    public function setNoext($noext = null)
    {
        $this->noext = $noext;

        return $this;
    }

    /**
     * Get noext.
     *
     * @return string|null
     */
    public function getNoext()
    {
        return $this->noext;
    }

    /**
     * Set rfc.
     *
     * @param string $rfc
     *
     * @return Proveedor
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;

        return $this;
    }

    /**
     * Get rfc.
     *
     * @return string
     */
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * Set contacto.
     *
     * @param string|null $contacto
     *
     * @return Proveedor
     */
    public function setContacto($contacto = null)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto.
     *
     * @return string|null
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set telefono.
     *
     * @param string|null $telefono
     *
     * @return Proveedor
     */
    public function setTelefono($telefono = null)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono.
     *
     * @return string|null
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Proveedor
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set idciudad.
     *
     * @param \LavandaBundle\Entity\Ciudad|null $idciudad
     *
     * @return Proveedor
     */
    public function setIdciudad(\LavandaBundle\Entity\Ciudad $idciudad = null)
    {
        $this->idciudad = $idciudad;

        return $this;
    }

    /**
     * Get idciudad.
     *
     * @return \LavandaBundle\Entity\Ciudad|null
     */
    public function getIdciudad()
    {
        return $this->idciudad;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
