<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UstawieniaRepository")
 */
class Ustawienia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zmienna;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wartosc;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZmienna(): ?string
    {
        return $this->zmienna;
    }

    public function setZmienna(string $zmienna): self
    {
        $this->zmienna = $zmienna;

        return $this;
    }

    public function getWartosc(): ?string
    {
        return $this->wartosc;
    }

    public function setWartosc(?string $wartosc): self
    {
        $this->wartosc = $wartosc;

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

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(?string $opis): self
    {
        $this->opis = $opis;

        return $this;
    }
}
