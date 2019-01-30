<?php

namespace App\Repository;

use App\Entity\Zgody;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Zgody|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zgody|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zgody[]    findAll()
 * @method Zgody[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZgodyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Zgody::class);
    }

    public function pobierzZgody()
    {
        return $this->findBy(['status' => 1]);
    }
}
