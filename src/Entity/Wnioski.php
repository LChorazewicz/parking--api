<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WnioskiRepository")
 */
class Wnioski
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=36, nullable=false)
     */
    private $idWniosku;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idKlienta;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $imie;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $Nazwisko;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $numerTelefonu;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $numerRejestracyjny;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dataDodania;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dataWaznosci;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Wnioski
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdWniosku()
    {
        return $this->idWniosku;
    }

    /**
     * @param string $idWniosku
     * @return Wnioski
     */
    public function setIdWniosku($idWniosku)
    {
        $this->idWniosku = $idWniosku;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdKlienta()
    {
        return $this->idKlienta;
    }

    /**
     * @param int $idKlienta
     * @return Wnioski
     */
    public function setIdKlienta($idKlienta)
    {
        $this->idKlienta = $idKlienta;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Wnioski
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * @param string $imie
     * @return Wnioski
     */
    public function setImie($imie)
    {
        $this->imie = $imie;
        return $this;
    }

    /**
     * @return string
     */
    public function getNazwisko()
    {
        return $this->Nazwisko;
    }

    /**
     * @param string $Nazwisko
     * @return Wnioski
     */
    public function setNazwisko($Nazwisko)
    {
        $this->Nazwisko = $Nazwisko;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumerTelefonu()
    {
        return $this->numerTelefonu;
    }

    /**
     * @param string $numerTelefonu
     * @return Wnioski
     */
    public function setNumerTelefonu($numerTelefonu)
    {
        $this->numerTelefonu = $numerTelefonu;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumerRejestracyjny()
    {
        return $this->numerRejestracyjny;
    }

    /**
     * @param string $numerRejestracyjny
     * @return Wnioski
     */
    public function setNumerRejestracyjny($numerRejestracyjny)
    {
        $this->numerRejestracyjny = $numerRejestracyjny;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataDodania()
    {
        return $this->dataDodania;
    }

    /**
     * @param mixed $dataDodania
     * @return Wnioski
     */
    public function setDataDodania($dataDodania)
    {
        $this->dataDodania = $dataDodania;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataWaznosci()
    {
        return $this->dataWaznosci;
    }

    /**
     * @param mixed $dataWaznosci
     * @return Wnioski
     */
    public function setDataWaznosci($dataWaznosci): Wnioski
    {
        $this->dataWaznosci = $dataWaznosci;
        return $this;
    }
}
