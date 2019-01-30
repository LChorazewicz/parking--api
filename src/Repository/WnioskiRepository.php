<?php

namespace App\Repository;

use App\Entity\Wnioski;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Wnioski|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wnioski|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wnioski[]    findAll()
 * @method Wnioski[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WnioskiRepository extends ServiceEntityRepository
{
    /**
     * @var KodyDostepoweRepository
     */
    private $kodSmsRepository;

    /**
     * @var ZgodyOdpowiedziKlientaRepository
     */
    private $zgodyRepository;

    /**
     * @var KlienciRepository
     */
    private $klienciRepository;

    /**
     * @var WnioskiHistoriaZmianStatusowRepository
     */
    private $historia;

    /**
     * WnioskiRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Wnioski::class);
        $this->kodSmsRepository = new KodyDostepoweRepository($registry);
        $this->zgodyRepository = new ZgodyOdpowiedziKlientaRepository($registry);
        $this->klienciRepository = new KlienciRepository($registry);
        $this->historia = new WnioskiHistoriaZmianStatusowRepository($registry);
    }

    /**
     * @param $numerTelefonu
     * @return Wnioski|null
     */
    public function znajdzOstatniWniosekNaNumerTelefonu($numerTelefonu)
    {
        return $this->findOneBy(['numerTelefonu' => $numerTelefonu]);
    }

    /**
     * @param Wnioski $wniosek
     * @return Wnioski
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function dodajWniosek(Wnioski $wniosek)
    {
        $this->_em->persist($wniosek);
        $this->_em->flush();
        $this->historia->dodajWpis($wniosek->getId(), $wniosek->getStatus());
        return $wniosek;
    }

    /**
     * @param $id
     * @param $nowyStatus
     * @return Wnioski
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function zmienStatusWniosku($id, $nowyStatus)
    {
        $wniosek = $this->pobierzWniosekPoId($id);
        $wniosek->setStatus($nowyStatus);
        $this->_em->persist($wniosek);
        $this->_em->flush();

        $this->historia->dodajWpis($wniosek->getId(), $wniosek->getStatus());
        return $wniosek;
    }

    /**
     * @param $id
     * @param int $oIleGodzin
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function zmienDateWaznosciWniosku($id, int $oIleGodzin)
    {
        $wniosek = $this->pobierzWniosekPoId($id);
        $nowadata = (new \DateTime('now'))->modify("+" . $oIleGodzin . " hours");
        $wniosek->setDataWaznosci($nowadata);
        $this->_em->persist($wniosek);
        $this->_em->flush();
    }

    /**
     * @param Wnioski $wniosek
     * @return Wnioski
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function aktualizujWniosekApi(Wnioski $wniosek)
    {
        $this->_em->persist($wniosek);
        $this->_em->flush();
        $this->historia->dodajWpis($wniosek->getId(), $wniosek->getStatus());
        return $wniosek;
    }

    /**
     * @param $idWniosku
     * @return Wnioski|null
     */
    public function pobierzWniosekPoIdWniosku($idWniosku)
    {
        return $this->findOneBy(['idWniosku' => $idWniosku]);
    }

    /**
     * @param $idWniosku
     * @return Wnioski|null
     */
    public function pobierzWniosekPoId($idWniosku)
    {
        return $this->findOneBy(['id' => $idWniosku]);
    }

    /**
     * @param Wnioski $wniosek
     * @return Wnioski
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function aktualizujWniosekApiBezWpisuDoHistorii(Wnioski $wniosek)
    {
        $this->_em->persist($wniosek);
        $this->_em->flush();
        return $wniosek;
    }

    /**
     * @return Wnioski
     * @throws \Exception
     */
    public function pobierzPrzeterminowaneWnioski()
    {
        return $this->createQueryBuilder('w')
            ->select()
            ->where('w.dataWaznosci <= :teraz')
            ->setParameter('teraz', (new \DateTime('now')))
            ->getQuery()->getResult();
    }

    /**
     * @return mixed
     */
    public function usunWnioski()
    {
        return $this->_em->createQuery("
            DELETE FROM App\Entity\Wnioski WHERE 1=1
        ")->execute();
    }
}
