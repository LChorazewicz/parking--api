<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UlicaRepository")
 */
class Ulica
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
    private $id_miasta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\Column(type="integer")
     */
    private $iloscMiejsc;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMiasta(): ?int
    {
        return $this->id_miasta;
    }

    public function setIdMiasta(int $id_miasta): self
    {
        $this->id_miasta = $id_miasta;

        return $this;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

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

    /**
     * @return integer
     */
    public function getIloscMiejsc()
    {
        return $this->iloscMiejsc;
    }

    /**
     * @param integer $iloscMiejsc
     */
    public function setIloscMiejsc($iloscMiejsc): void
    {
        $this->iloscMiejsc = $iloscMiejsc;
    }
}
