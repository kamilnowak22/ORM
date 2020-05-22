<?php

namespace Entity;

/**
 * Dodatkowe
 */
class Dodatkowe
{
    /**
     * @var string
     */
    private $nazwa;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \Entity\Nieruchomosc
     */
    private $nieruchomosci;


    /**
     * Set nazwa.
     *
     * @param string $nazwa
     *
     * @return Dodatkowe
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa.
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
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
     * Set nieruchomosci.
     *
     * @param \Entity\Nieruchomosc|null $nieruchomosci
     *
     * @return Dodatkowe
     */
    public function setNieruchomosci(\Entity\Nieruchomosc $nieruchomosci = null)
    {
        $this->nieruchomosci = $nieruchomosci;

        return $this;
    }

    /**
     * Get nieruchomosci.
     *
     * @return \Entity\Nieruchomosc|null
     */
    public function getNieruchomosci()
    {
        return $this->nieruchomosci;
    }
}
