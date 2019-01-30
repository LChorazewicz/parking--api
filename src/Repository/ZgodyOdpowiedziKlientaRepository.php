<?php

namespace App\Repository;

use App\Entity\ZgodyOdpowiedziKlienta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ZgodyOdpowiedziKlienta|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZgodyOdpowiedziKlienta|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZgodyOdpowiedziKlienta[]    findAll()
 * @method ZgodyOdpowiedziKlienta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZgodyOdpowiedziKlientaRepository extends ServiceEntityRepository
{
    /**
     * ZgodyOdpowiedziKlientaRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ZgodyOdpowiedziKlienta::class);
    }

    /**
     * @param $idWniosku
     * @return ZgodyOdpowiedziKlienta[]
     */
    public function pobierzZgody($idWniosku)
    {
        return $this->findBy(['idWniosku' => $idWniosku, 'status' => 1]);
    }

    /**
     * @param ZgodyOdpowiedziKlienta[] $zgody
     * @throws \Doctrine\ORM\ORMException
     */
    public function dodajZgody(array $zgody)
    {
        foreach ($zgody as $zgoda){
            $this->_em->persist($zgoda);
        }
        $this->_em->flush();
    }

    /**
     * @return mixed
     */
    public function usunZgody()
    {
        return $this->_em->createQuery("
            DELETE FROM App\Entity\ZgodyOdpowiedziKlienta WHERE 1=1
        ")->execute();
    }
}
