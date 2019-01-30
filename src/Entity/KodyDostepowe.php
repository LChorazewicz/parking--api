<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KodyDostepoweRepository")
 */
class KodyDostepowe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $kod;

    /**
     * @ORM\Column(type="integer")
     */
    private $idWniosku;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dataDodania;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataWaznosci;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKod(): ?string
    {
        return $this->kod;
    }

    public function setKod(string $kod): self
    {
        $this->kod = $kod;

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

    public function getDataDodania(): ?\DateTimeInterface
    {
        return $this->dataDodania;
    }

    public function setDataDodania(\DateTimeInterface $dataDodania): self
    {
        $this->dataDodania = $dataDodania;

        return $this;
    }

    public function getDataWaznosci(): ?\DateTimeInterface
    {
        return $this->dataWaznosci;
    }

    public function setDataWaznosci(\DateTimeInterface $dataWaznosci): self
    {
        $this->dataWaznosci = $dataWaznosci;

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
