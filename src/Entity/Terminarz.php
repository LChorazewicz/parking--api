<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TerminarzRepository")
 */
class Terminarz
{
    /**
     * @var $id int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var $idWniosku int
     * @ORM\Column(type="integer")
     */
    private $idWniosku;

    /**
     * @ORM\Column(type="integer")
     * @var $status int
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     * @var $dzien int
     */
    private $dzien;

    /**
     * @ORM\Column(type="integer")
     * @var $miesiac int
     */
    private $miesiac;

    /**
     * @ORM\Column(type="integer")
     * @var $rok int
     */
    private $rok;

    /**
     * @ORM\Column(type="integer")
     * @var $godzina int
     */
    private $godzina;

    /**
     * @var $sumaKontrolnaAdresu string
     * @ORM\Column(type="string", length=11)
     */
    private $sumaKontrolnaAdresu;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Terminarz
     */
    public function setId(int $id): Terminarz
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdWniosku(): int
    {
        return $this->idWniosku;
    }

    /**
     * @param int $idWniosku
     * @return Terminarz
     */
    public function setIdWniosku(int $idWniosku): Terminarz
    {
        $this->idWniosku = $idWniosku;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Terminarz
     */
    public function setStatus(int $status): Terminarz
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getDzien(): int
    {
        return $this->dzien;
    }

    /**
     * @param int $dzien
     * @return Terminarz
     */
    public function setDzien(int $dzien): Terminarz
    {
        $this->dzien = $dzien;
        return $this;
    }

    /**
     * @return int
     */
    public function getMiesiac(): int
    {
        return $this->miesiac;
    }

    /**
     * @param int $miesiac
     * @return Terminarz
     */
    public function setMiesiac(int $miesiac): Terminarz
    {
        $this->miesiac = $miesiac;
        return $this;
    }

    /**
     * @return int
     */
    public function getRok(): int
    {
        return $this->rok;
    }

    /**
     * @param int $rok
     * @return Terminarz
     */
    public function setRok(int $rok): Terminarz
    {
        $this->rok = $rok;
        return $this;
    }

    /**
     * @return int
     */
    public function getGodzina(): int
    {
        return $this->godzina;
    }

    /**
     * @param int $godzina
     * @return Terminarz
     */
    public function setGodzina(int $godzina): Terminarz
    {
        $this->godzina = $godzina;
        return $this;
    }

    /**
     * @return string
     */
    public function getSumaKontrolnaAdresu(): string
    {
        return $this->sumaKontrolnaAdresu;
    }

    /**
     * @param string $sumaKontrolnaAdresu
     * @return Terminarz
     */
    public function setSumaKontrolnaAdresu(string $sumaKontrolnaAdresu): Terminarz
    {
        $this->sumaKontrolnaAdresu = $sumaKontrolnaAdresu;
        return $this;
    }
}
