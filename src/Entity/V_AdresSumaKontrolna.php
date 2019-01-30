<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 25.12.18
 * Time: 11:23
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class V_AdresSumaKontrolna
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\V_AdresSumaKontrolnaRepository")
 */
class V_AdresSumaKontrolna
{
    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\Id
     * @var string
     */
    private $sumaKontrolna;

    /**
     * @ORM\Column(type="integer")
     */
    private $ulica;

    /**
     * @ORM\Column(type="integer")
     */
    private $miasto;

    /**
     * @ORM\Column(type="integer")
     */
    private $wojewodztwo;
    /**
     * @return string
     */
    public function getSumaKontrolna(): string
    {
        return $this->sumaKontrolna;
    }
}