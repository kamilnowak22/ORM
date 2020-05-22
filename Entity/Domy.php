<?php

namespace Entity;

/**
 * Domy
 */
class Domy
{
    /**
     * @var float
     */
    private $powierzchnia_dzialki;

    /**
     * @var int
     */
    private $rok_budowy;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \Entity\Nieruchomosc
     */
    private $nieruchomosc;


    /**
     * Set powierzchniaDzialki.
     *
     * @param float $powierzchniaDzialki
     *
     * @return Domy
     */
    public function setPowierzchniaDzialki($powierzchniaDzialki)
    {
        $this->powierzchnia_dzialki = $powierzchniaDzialki;

        return $this;
    }

    /**
     * Get powierzchniaDzialki.
     *
     * @return float
     */
    public function getPowierzchniaDzialki()
    {
        return $this->powierzchnia_dzialki;
    }

    /**
     * Set rokBudowy.
     *
     * @param int $rokBudowy
     *
     * @return Domy
     */
    public function setRokBudowy($rokBudowy)
    {
        $this->rok_budowy = $rokBudowy;

        return $this;
    }

    /**
     * Get rokBudowy.
     *
     * @return int
     */
    public function getRokBudowy()
    {
        return $this->rok_budowy;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nieruchomosc.
     *
     * @param \Entity\Nieruchomosc|null $nieruchomosc
     *
     * @return Domy
     */
    public function setNieruchomosc(\Entity\Nieruchomosc $nieruchomosc = null)
    {
        $this->nieruchomosc = $nieruchomosc;

        return $this;
    }

    /**
     * Get nieruchomosc.
     *
     * @return \Entity\Nieruchomosc|null
     */
    public function getNieruchomosc()
    {
        return $this->nieruchomosc;
    }
}
