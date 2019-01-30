<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WnioskiHistoriaZmianStatusowRepository")
 */
class WnioskiHistoriaZmianStatusow
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
    private $idWniosku;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idStaregoStatusu;

    /**
     * @ORM\Column(type="integer")
     */
    private $idNowegoStatusu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataZmiany;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdStaregoStatusu(): ?int
    {
        return $this->idStaregoStatusu;
    }

    public function setIdStaregoStatusu(?int $idStaregoStatusu): self
    {
        $this->idStaregoStatusu = $idStaregoStatusu;

        return $this;
    }

    public function getIdNowegoStatusu(): ?int
    {
        return $this->idNowegoStatusu;
    }

    public function setIdNowegoStatusu(int $idNowegoStatusu): self
    {
        $this->idNowegoStatusu = $idNowegoStatusu;

        return $this;
    }

    public function getDataZmiany(): ?\DateTimeInterface
    {
        return $this->dataZmiany;
    }

    public function setDataZmiany(\DateTimeInterface $dataZmiany): self
    {
        $this->dataZmiany = $dataZmiany;

        return $this;
    }
}
