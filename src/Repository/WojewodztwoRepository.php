<?php

namespace App\Repository;

use App\Entity\Wojewodztwo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Wojewodztwo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wojewodztwo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wojewodztwo[]    findAll()
 * @method Wojewodztwo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WojewodztwoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Wojewodztwo::class);
    }

    /**
     * @return Wojewodztwo[] Returns an array of Wojewodztwo objects
     */
    public function pobierzWszystkieWojewodztwa()
    {
        return $this->findBy(['status' => 1]);
    }
}
