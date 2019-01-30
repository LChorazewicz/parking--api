<?php

namespace App\Repository;

use App\Entity\Klienci;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Klienci|null find($id, $lockMode = null, $lockVersion = null)
 * @method Klienci|null findOneBy(array $criteria, array $orderBy = null)
 * @method Klienci[]    findAll()
 * @method Klienci[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KlienciRepository extends ServiceEntityRepository
{
    /**
     * KlienciRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Klienci::class);
    }

    /**
     * @param Klienci $klient
     * @return Klienci
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function stworzKlienta(Klienci $klient)
    {
        $this->_em->persist($klient);
        $this->_em->flush();
        return $klient;
    }

    /**
     * @return mixed
     */
    public function usunKientow()
    {
        return $this->_em->createQuery("
            DELETE FROM App\Entity\Klienci WHERE 1=1
        ")->execute();
    }
}
