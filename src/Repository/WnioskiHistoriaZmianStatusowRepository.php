<?php

namespace App\Repository;

use App\Entity\WnioskiHistoriaZmianStatusow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WnioskiHistoriaZmianStatusow|null find($id, $lockMode = null, $lockVersion = null)
 * @method WnioskiHistoriaZmianStatusow|null findOneBy(array $criteria, array $orderBy = null)
 * @method WnioskiHistoriaZmianStatusow[]    findAll()
 * @method WnioskiHistoriaZmianStatusow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WnioskiHistoriaZmianStatusowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WnioskiHistoriaZmianStatusow::class);
    }

    /**
     * @param $idWniosku
     * @param $idNowegoStatusu
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function dodajWpis($idWniosku, $idNowegoStatusu)
    {
        $ostatni = $this->findOneBy(['idWniosku' => $idWniosku], ['id' => 'desc']);

        if($ostatni !== null){
            $ostatni = $ostatni->getIdNowegoStatusu();
        }

        $encja = new WnioskiHistoriaZmianStatusow();
        $encja->setIdWniosku($idWniosku)
            ->setDataZmiany(new \DateTime('now'))
            ->setIdStaregoStatusu($ostatni)
            ->setIdNowegoStatusu($idNowegoStatusu);
        $this->_em->persist($encja);
        $this->_em->flush();
    }

    /**
     * @param $idWniosku
     * @return WnioskiHistoriaZmianStatusow|null
     */
    public function znajdzOstatni($idWniosku)
    {
        return $this->findOneBy(['idWniosku' => $idWniosku], ['id' => 'desc']);
    }

    /**
     * @return mixed
     */
    public function usunHistorie()
    {
        return $this->_em->createQuery("
            DELETE FROM App\Entity\WnioskiHistoriaZmianStatusow WHERE 1=1
        ")->execute();
    }
}
