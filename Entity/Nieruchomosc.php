<?php

namespace Entity;

/**
 * Nieruchomosc
 */
class Nieruchomosc
{
    /**
     * @var string
     */
    private $typ_oferty;

    /**
     * @var float
     */
    private $powierzchnia;

    /**
     * @var float
     */
    private $cena;

    /**
     * @var float
     */
    private $cena_m2;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \Entity\Mieszkanie
     */
    private $mieszkanie;

    /**
     * @var \Entity\Miasto
     */
    private $miasto;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $opcjekomunikacji;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->opcjekomunikacji = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set typOferty.
     *
     * @param string $typOferty
     *
     * @return Nieruchomosc
     */
    public function setTypOferty($typOferty)
    {
        $this->typ_oferty = $typOferty;

        return $this;
    }

    /**
     * Get typOferty.
     *
     * @return string
     */
    public function getTypOferty()
    {
        return $this->typ_oferty;
    }

    /**
     * Set powierzchnia.
     *
     * @param float $powierzchnia
     *
     * @return Nieruchomosc
     */
    public function setPowierzchnia($powierzchnia)
    {
        $this->powierzchnia = $powierzchnia;

        return $this;
    }

    /**
     * Get powierzchnia.
     *
     * @return float
     */
    public function getPowierzchnia()
    {
        return $this->powierzchnia;
    }

    /**
     * Set cena.
     *
     * @param float $cena
     *
     * @return Nieruchomosc
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

        return $this;
    }

    /**
     * Get cena.
     *
     * @return float
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Set cenaM2.
     *
     * @param float $cenaM2
     *
     * @return Nieruchomosc
     */
    public function setCenaM2($cenaM2)
    {
        $this->cena_m2 = $cenaM2;

        return $this;
    }

    /**
     * Get cenaM2.
     *
     * @return float
     */
    public function getCenaM2()
    {
        return $this->cena_m2;
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
     * Set mieszkanie.
     *
     * @param \Entity\Mieszkanie|null $mieszkanie
     *
     * @return Nieruchomosc
     */
    public function setMieszkanie(\Entity\Mieszkanie $mieszkanie = null)
    {
        $this->mieszkanie = $mieszkanie;

        return $this;
    }

    /**
     * Get mieszkanie.
     *
     * @return \Entity\Mieszkanie|null
     */
    public function getMieszkanie()
    {
        return $this->mieszkanie;
    }

    /**
     * Set miasto.
     *
     * @param \Entity\Miasto|null $miasto
     *
     * @return Nieruchomosc
     */
    public function setMiasto(\Entity\Miasto $miasto = null)
    {
        $this->miasto = $miasto;

        return $this;
    }

    /**
     * Get miasto.
     *
     * @return \Entity\Miasto|null
     */
    public function getMiasto()
    {
        return $this->miasto;
    }

    /**
     * Add opcjekomunikacji.
     *
     * @param \Entity\Komunikacja $opcjekomunikacji
     *
     * @return Nieruchomosc
     */
    public function addOpcjekomunikacji(\Entity\Komunikacja $opcjekomunikacji)
    {
        $this->opcjekomunikacji[] = $opcjekomunikacji;

        return $this;
    }

    /**
     * Remove opcjekomunikacji.
     *
     * @param \Entity\Komunikacja $opcjekomunikacji
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOpcjekomunikacji(\Entity\Komunikacja $opcjekomunikacji)
    {
        return $this->opcjekomunikacji->removeElement($opcjekomunikacji);
    }

    /**
     * Get opcjekomunikacji.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOpcjekomunikacji()
    {
        return $this->opcjekomunikacji;
    }
    /**
     * @var string
     */
    private $numer;


    /**
     * Set numer.
     *
     * @param string $numer
     *
     * @return Nieruchomosc
     */
    public function setNumer($numer)
    {
        $this->numer = $numer;

        return $this;
    }

    /**
     * Get numer.
     *
     * @return string
     */
    public function getNumer()
    {
        return $this->numer;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $materialy;


    /**
     * Add materialy.
     *
     * @param \Entity\Material $materialy
     *
     * @return Nieruchomosc
     */
    public function addMaterialy(\Entity\Material $materialy)
    {
        $this->materialy[] = $materialy;

        return $this;
    }

    /**
     * Remove materialy.
     *
     * @param \Entity\Material $materialy
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMaterialy(\Entity\Material $materialy)
    {
        return $this->materialy->removeElement($materialy);
    }

    /**
     * Get materialy.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaterialy()
    {
        return $this->materialy;
    }


    ///////////////////////////////
	
	public function czyOpcjaKomunikacji($id)
	{
		foreach($this->opcjekomunikacji as $opcja) {
			if ($opcja->getId() == $id) {
				return true;
			}
		}
			
		return false;
	}

    public function pobierzKomunikacje()
    {
        $komunikacja = [];
        foreach ($this->getOpcjekomunikacji() as $k) {
            $komunikacja[] = $k->getNazwa();
        }
        return empty($komunikacja) ? '-' : implode(', ', $komunikacja);
    }

    public function pobierzDodatkowe()
    {
        $dodatkowe = [];
        foreach ($this->getDodatkowe() as $k) {
            $dodatkowe[] = $k->getNazwa();
        }
        return empty($dodatkowe) ? '-' : implode(', ', $dodatkowe);
    }

    /**
     * @var \Entity\Dom
     */
    private $dom;

    /**
     * @var \Entity\Grunt
     */
    private $grunt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $dodatkowe;


    /**
     * Set dom.
     *
     * @param \Entity\Dom|null $dom
     *
     * @return Nieruchomosc
     */
    public function setDom(\Entity\Dom $dom = null)
    {
        $this->dom = $dom;

        return $this;
    }

    /**
     * Get dom.
     *
     * @return \Entity\Dom|null
     */
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * Set grunt.
     *
     * @param \Entity\Grunt|null $grunt
     *
     * @return Nieruchomosc
     */
    public function setGrunt(\Entity\Grunt $grunt = null)
    {
        $this->grunt = $grunt;

        return $this;
    }

    /**
     * Get grunt.
     *
     * @return \Entity\Grunt|null
     */
    public function getGrunt()
    {
        return $this->grunt;
    }

    /**
     * Add dodatkowe.
     *
     * @param \Entity\Dodatkowa $dodatkowe
     *
     * @return Nieruchomosc
     */
    public function addDodatkowe(\Entity\Dodatkowa $dodatkowe)
    {
        $this->dodatkowe[] = $dodatkowe;

        return $this;
    }

    /**
     * Remove dodatkowe.
     *
     * @param \Entity\Dodatkowa $dodatkowe
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDodatkowe(\Entity\Dodatkowa $dodatkowe)
    {
        return $this->dodatkowe->removeElement($dodatkowe);
    }

    /**
     * Get dodatkowe.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDodatkowe()
    {
        return $this->dodatkowe;
    }
}
