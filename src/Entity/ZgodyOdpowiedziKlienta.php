<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZgodyOdpowiedziKlientaRepository")
 */
class ZgodyOdpowiedziKlienta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idZgody;

    /**
     * @ORM\Column(type="integer")
     */
    private $idWniosku;

    /**
     * @ORM\Column(type="boolean")
     */
    private $odpowiedz;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDodania;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdZgody(): ?int
    {
        return $this->idZgody;
    }

    public function setIdZgody(int $idZgody): self
    {
        $this->idZgody = $idZgody;

        return $this;
    }

    public function getIdWniosku(): ?int
    {
        return $this->idWniosku;
    }

    public function setIdWniosku(int $idWniosku): self
    {
        $this->idWniosku = $idWniosku;

        return $this;
    }

    public function getOdpowiedz(): ?bool
    {
        return $this->odpowiedz;
    }

    public function setOdpowiedz(bool $odpowiedz): self
    {
        $this->odpowiedz = $odpowiedz;

        return $this;
    }

    public function getDataDodania(): ?\DateTimeInterface
    {
        return $this->dataDodania;
    }

    public function setDataDodania(\DateTimeInterface $dataDodania): self
    {
        $this->dataDodania = $dataDodania;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
