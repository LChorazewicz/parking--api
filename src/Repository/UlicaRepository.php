<?php

namespace App\Repository;

use App\Entity\Ulica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ulica|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ulica|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ulica[]    findAll()
 * @method Ulica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UlicaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ulica::class);
    }

    public function pobierzWszystkieUlice($idMiasta)
    {
        return $this->findBy(['status' => 1, 'id_miasta' => $idMiasta]);
    }
}
