<?php

namespace App\Repository;

use App\Entity\Ustawienia;
use App\Library\ZmienneSystemowe;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ustawienia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ustawienia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ustawienia[]    findAll()
 * @method Ustawienia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UstawieniaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ustawienia::class);
    }

    /**
     * @param string $nazwa
     * @return string|null|DateTime
     * @throws \Exception
     */
    public function pobierzZmienna(string $nazwa)
    {
        $wartosc = $this->findOneBy(['zmienna' => $nazwa, 'status' => 1])->getWartosc();
        switch ($nazwa){
            case ZmienneSystemowe::DATA_SYSTEMOWA:{
                $wartosc = ($wartosc === null) ? (new \DateTime('now'))->format('d-m-Y') : $wartosc;
                break;
            }
            case ZmienneSystemowe::DATA_RESTARTU_SESJI:{
                $wartosc = ($wartosc === null) ? null : (new \DateTime($wartosc));
                break;
            }
        }
        return $wartosc;
    }
}
