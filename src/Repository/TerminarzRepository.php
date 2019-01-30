<?php

namespace App\Repository;

use App\DTO\Adresy\SumaKontrolna;
use App\DTO\Daty\DataIGodzina;
use App\Entity\Terminarz;
use App\Library\Data\DataInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Terminarz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Terminarz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Terminarz[]    findAll()
 * @method Terminarz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TerminarzRepository extends ServiceEntityRepository
{
    /**
     * TerminarzRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Terminarz::class);
    }

    /**
     * @param \App\DTO\Daty\DostepnoscDatIGodzin $datyIGodziny
     * @param SumaKontrolna $adres
     * @return bool
     */
    public function sprawdzDostepnoscWybranychTerminow(\App\DTO\Daty\DostepnoscDatIGodzin $datyIGodziny, SumaKontrolna $adres)
    {
        $kolekcja = $datyIGodziny->pogrupujKolekcje();
        $status = true;

        foreach ($kolekcja as $dni){
            /**
             * @var $dzien DataInterface
             * @var $dni DataIGodzina[]
             */
            $godziny = [];
            foreach ($dni as $dzien){
                $godziny[] = $dzien->pobierzGodzine();
            }

            if(empty($godziny)){
                $status = false;
                break;
            }

            if($status && !$this->sprawdzTerminy($dni[0]->pobierzDzien(), $dni[0]->pobierzMiesiac(), $dni[0]->pobierzRok(), $godziny, $adres)){
                $status = false;
                break;
            }
        }

        return $status;
    }

    /**
     * @param int $dzien
     * @param int $miesiac
     * @param int $rok
     * @param array $godziny
     * @param SumaKontrolna $adres
     * @return bool
     */
    private function sprawdzTerminy(int $dzien, int $miesiac, int $rok, array $godziny, SumaKontrolna $adres){
        $wynik = 0;
        $iloscWolnychMiejsc = $this->createQueryBuilder('t')
            ->select(['(u.iloscMiejsc - COUNT(t.id)) as ilosc_wolnych_miejsc'])
            ->leftJoin('App\Entity\V_AdresSumaKontrolna', 'v', Expr\Join::WITH, 'v.sumaKontrolna = t.sumaKontrolnaAdresu')
            ->leftJoin('App:Ulica', 'u', Expr\Join::WITH, 'u.id = v.ulica ')
            ->where('t.status = :status')
            ->andWhere('t.dzien = :dzien')
            ->andWhere('t.miesiac = :miesiac')
            ->andWhere('t.rok = :rok')
            ->andWhere('t.godzina IN (:godzina)')
            ->andWhere('v.sumaKontrolna = :sumaKontrolna')
            ->andWhere('u.id = :ulica')
            ->setParameter('status', 1)
            ->setParameter('dzien', $dzien)
            ->setParameter('miesiac', $miesiac)
            ->setParameter('rok', $rok)
            ->setParameter('godzina', $godziny)
            ->setParameter('ulica', $adres->ulica)
            ->setParameter('sumaKontrolna', $adres->sumaKontrola)
            ->setMaxResults(1)
            ->getQuery()->getResult();

        if(!empty($iloscWolnychMiejsc) &&
            isset($iloscWolnychMiejsc[0]) &&
            isset($iloscWolnychMiejsc[0]['ilosc_wolnych_miejsc']) &&
            intval($iloscWolnychMiejsc[0]['ilosc_wolnych_miejsc']) > 0 && !is_null($iloscWolnychMiejsc[0]['ilosc_wolnych_miejsc'])){
            $wynik = intval($iloscWolnychMiejsc[0]['ilosc_wolnych_miejsc']);
        }

        if(is_null($iloscWolnychMiejsc[0]['ilosc_wolnych_miejsc'])){
            $wynik = $iloscWolnychMiejsc[0]['iloscMiejsc'];
        }

        return !empty($wynik) && $wynik > 0;
    }

    /**
     * @return mixed
     */
    public function usunTerminy()
    {
        return $this->_em->createQuery("
            DELETE FROM App\Entity\Terminarz WHERE 1=1
        ")->execute();
    }
}
