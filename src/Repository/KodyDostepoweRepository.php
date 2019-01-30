<?php

namespace App\Repository;

use App\Entity\KodyDostepowe;
use App\Library\Generatory\KodSms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method KodyDostepowe|null find($id, $lockMode = null, $lockVersion = null)
 * @method KodyDostepowe|null findOneBy(array $criteria, array $orderBy = null)
 * @method KodyDostepowe[]    findAll()
 * @method KodyDostepowe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KodyDostepoweRepository extends ServiceEntityRepository
{

    /**
     * KodyDostepoweRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, KodyDostepowe::class);
    }

    /**
     * @param $idWniosku
     * @param $kodSms
     * @return mixed
     * @throws \Exception
     */
    public function pobierzKodDostepu($idWniosku, $kodSms)
    {
        $query = $this->createQueryBuilder('k')
            ->andWhere('k.idWniosku = :idWniosku')
            ->andWhere('k.kod = :kodSms')
            ->andWhere('k.dataWaznosci >= :teraz')
            ->andWhere('k.status = :status')
            ->setParameter('idWniosku', $idWniosku)
            ->setParameter('kodSms', $kodSms)
            ->setParameter('status', 1)
            ->setParameter('teraz', new \DateTime('now'))
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery();
            return $query->getResult();
    }

    /**
     * @param int $idWniosku
     * @throws \Doctrine\ORM\ORMException
     */
    public function dezaktywujKodySms(int $idWniosku)
    {
        $kolekcja = $this->findBy(['idWniosku' => $idWniosku]);
        foreach ($kolekcja as $kod){
            $kod->setStatus(0);
            $this->_em->persist($kod);
            $this->_em->flush();
        }
    }

    /**
     * @param int $idWniosku
     * @param int $waznosc
     * @return KodyDostepowe
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function dodajKodSms(int $idWniosku, int $waznosc)
    {
        $this->dezaktywujKodySms($idWniosku);
        $kod = new KodyDostepowe();
        $kod->setStatus(1)
            ->setIdWniosku($idWniosku)
            ->setKod(KodSms::generuj())
            ->setDataDodania(new \DateTime('now'))
            ->setDataWaznosci((new \DateTime('now'))->modify("+" . $waznosc . " hours"));
        $this->_em->persist($kod);
        $this->_em->flush();
        return $kod;
    }

    /**
     * @return mixed
     */
    public function usunKody()
    {
        return $this->_em->createQuery("
            DELETE FROM App\Entity\KodyDostepowe WHERE 1=1
        ")->execute();
    }
}
