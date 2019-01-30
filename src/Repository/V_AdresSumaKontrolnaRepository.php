<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 25.12.18
 * Time: 11:20
 */

namespace App\Repository;


use App\Entity\V_AdresSumaKontrolna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class V_AdresSumaKontrolnaRepository
 * @package App\Repository
 */
class V_AdresSumaKontrolnaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, V_AdresSumaKontrolna::class);
    }
    /**
     * @return bool
     */
    public function sprawdzCzySumaKontrolnaIstnieje($suma)
    {
        return ($this->findOneBy(['sumaKontrolna' => $suma])) ? true : false;
    }
}