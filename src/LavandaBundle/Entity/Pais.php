<?php

namespace LavandaBundle\Entity;

/**
 * Pais
 */
class Pais
{
    /**
     * @var string
     */
    private $paiscodigo = '';

    /**
     * @var string
     */
    private $paisnombre = '';

    /**
     * @var string
     */
    private $paiscontinente = 'Asia';

    /**
     * @var string
     */
    private $paisregion = '';

    /**
     * @var float
     */
    private $paisarea = '0';

    /**
     * @var int|null
     */
    private $paisindependencia;

    /**
     * @var int
     */
    private $paispoblacion = '0';

    /**
     * @var float|null
     */
    private $paisexpectativadevida;

    /**
     * @var float|null
     */
    private $paisproductointernobruto;

    /**
     * @var float|null
     */
    private $paisproductointernobrutoantiguo;

    /**
     * @var string
     */
    private $paisnombrelocal = '';

    /**
     * @var string
     */
    private $paisgobierno = '';

    /**
     * @var string|null
     */
    private $paisjefedeestado;

    /**
     * @var int|null
     */
    private $paiscapital;

    /**
     * @var string
     */
    private $paiscodigo2 = '';


    /**
     * Get paiscodigo.
     *
     * @return string
     */
    public function getPaiscodigo()
    {
        return $this->paiscodigo;
    }

    /**
     * Set paisnombre.
     *
     * @param string $paisnombre
     *
     * @return Pais
     */
    public function setPaisnombre($paisnombre)
    {
        $this->paisnombre = $paisnombre;

        return $this;
    }

    /**
     * Get paisnombre.
     *
     * @return string
     */
    public function getPaisnombre()
    {
        return $this->paisnombre;
    }

    /**
     * Set paiscontinente.
     *
     * @param string $paiscontinente
     *
     * @return Pais
     */
    public function setPaiscontinente($paiscontinente)
    {
        $this->paiscontinente = $paiscontinente;

        return $this;
    }

    /**
     * Get paiscontinente.
     *
     * @return string
     */
    public function getPaiscontinente()
    {
        return $this->paiscontinente;
    }

    /**
     * Set paisregion.
     *
     * @param string $paisregion
     *
     * @return Pais
     */
    public function setPaisregion($paisregion)
    {
        $this->paisregion = $paisregion;

        return $this;
    }

    /**
     * Get paisregion.
     *
     * @return string
     */
    public function getPaisregion()
    {
        return $this->paisregion;
    }

    /**
     * Set paisarea.
     *
     * @param float $paisarea
     *
     * @return Pais
     */
    public function setPaisarea($paisarea)
    {
        $this->paisarea = $paisarea;

        return $this;
    }

    /**
     * Get paisarea.
     *
     * @return float
     */
    public function getPaisarea()
    {
        return $this->paisarea;
    }

    /**
     * Set paisindependencia.
     *
     * @param int|null $paisindependencia
     *
     * @return Pais
     */
    public function setPaisindependencia($paisindependencia = null)
    {
        $this->paisindependencia = $paisindependencia;

        return $this;
    }

    /**
     * Get paisindependencia.
     *
     * @return int|null
     */
    public function getPaisindependencia()
    {
        return $this->paisindependencia;
    }

    /**
     * Set paispoblacion.
     *
     * @param int $paispoblacion
     *
     * @return Pais
     */
    public function setPaispoblacion($paispoblacion)
    {
        $this->paispoblacion = $paispoblacion;

        return $this;
    }

    /**
     * Get paispoblacion.
     *
     * @return int
     */
    public function getPaispoblacion()
    {
        return $this->paispoblacion;
    }

    /**
     * Set paisexpectativadevida.
     *
     * @param float|null $paisexpectativadevida
     *
     * @return Pais
     */
    public function setPaisexpectativadevida($paisexpectativadevida = null)
    {
        $this->paisexpectativadevida = $paisexpectativadevida;

        return $this;
    }

    /**
     * Get paisexpectativadevida.
     *
     * @return float|null
     */
    public function getPaisexpectativadevida()
    {
        return $this->paisexpectativadevida;
    }

    /**
     * Set paisproductointernobruto.
     *
     * @param float|null $paisproductointernobruto
     *
     * @return Pais
     */
    public function setPaisproductointernobruto($paisproductointernobruto = null)
    {
        $this->paisproductointernobruto = $paisproductointernobruto;

        return $this;
    }

    /**
     * Get paisproductointernobruto.
     *
     * @return float|null
     */
    public function getPaisproductointernobruto()
    {
        return $this->paisproductointernobruto;
    }

    /**
     * Set paisproductointernobrutoantiguo.
     *
     * @param float|null $paisproductointernobrutoantiguo
     *
     * @return Pais
     */
    public function setPaisproductointernobrutoantiguo($paisproductointernobrutoantiguo = null)
    {
        $this->paisproductointernobrutoantiguo = $paisproductointernobrutoantiguo;

        return $this;
    }

    /**
     * Get paisproductointernobrutoantiguo.
     *
     * @return float|null
     */
    public function getPaisproductointernobrutoantiguo()
    {
        return $this->paisproductointernobrutoantiguo;
    }

    /**
     * Set paisnombrelocal.
     *
     * @param string $paisnombrelocal
     *
     * @return Pais
     */
    public function setPaisnombrelocal($paisnombrelocal)
    {
        $this->paisnombrelocal = $paisnombrelocal;

        return $this;
    }

    /**
     * Get paisnombrelocal.
     *
     * @return string
     */
    public function getPaisnombrelocal()
    {
        return $this->paisnombrelocal;
    }

    /**
     * Set paisgobierno.
     *
     * @param string $paisgobierno
     *
     * @return Pais
     */
    public function setPaisgobierno($paisgobierno)
    {
        $this->paisgobierno = $paisgobierno;

        return $this;
    }

    /**
     * Get paisgobierno.
     *
     * @return string
     */
    public function getPaisgobierno()
    {
        return $this->paisgobierno;
    }

    /**
     * Set paisjefedeestado.
     *
     * @param string|null $paisjefedeestado
     *
     * @return Pais
     */
    public function setPaisjefedeestado($paisjefedeestado = null)
    {
        $this->paisjefedeestado = $paisjefedeestado;

        return $this;
    }

    /**
     * Get paisjefedeestado.
     *
     * @return string|null
     */
    public function getPaisjefedeestado()
    {
        return $this->paisjefedeestado;
    }

    /**
     * Set paiscapital.
     *
     * @param int|null $paiscapital
     *
     * @return Pais
     */
    public function setPaiscapital($paiscapital = null)
    {
        $this->paiscapital = $paiscapital;

        return $this;
    }

    /**
     * Get paiscapital.
     *
     * @return int|null
     */
    public function getPaiscapital()
    {
        return $this->paiscapital;
    }

    /**
     * Set paiscodigo2.
     *
     * @param string $paiscodigo2
     *
     * @return Pais
     */
    public function setPaiscodigo2($paiscodigo2)
    {
        $this->paiscodigo2 = $paiscodigo2;

        return $this;
    }

    /**
     * Get paiscodigo2.
     *
     * @return string
     */
    public function getPaiscodigo2()
    {
        return $this->paiscodigo2;
    }
}
