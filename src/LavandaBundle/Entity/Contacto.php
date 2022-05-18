<?php

namespace LavandaBundle\Entity;

/**
 * Contacto
 */
class Contacto
{
    /**
     * @var integer
     */
    private $idcontacto;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $comentarios;


    /**
     * Get idcontacto
     *
     * @return integer
     */
    public function getIdcontacto()
    {
        return $this->idcontacto;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Contacto
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Contacto
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Contacto
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contacto
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return Contacto
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }
    /**
     * @var \LavandaBundle\Entity\Sucursal
     */
    private $idsucursal;


    /**
     * Set idsucursal
     *
     * @param \LavandaBundle\Entity\Sucursal $idsucursal
     *
     * @return Contacto
     */
    public function setIdsucursal(\LavandaBundle\Entity\Sucursal $idsucursal = null)
    {
        $this->idsucursal = $idsucursal;

        return $this;
    }

    /**
     * Get idsucursal
     *
     * @return \LavandaBundle\Entity\Sucursal
     */
    public function getIdsucursal()
    {
        return $this->idsucursal;
    }
}
