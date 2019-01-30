<?php

namespace App\Repository;

use App\Entity\Miasto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Miasto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Miasto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Miasto[]    findAll()
 * @method Miasto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiastoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Miasto::class);
    }

    /**
     * @return Miasto[] Returns an array of Wojewodztwo objects
     */
    public function pobierzWszystkieMiasta($idWojewodztwa)
    {
        return $this->findBy(['status' => 1, 'id_wojewodztwa' => $idWojewodztwa]);
    }

    /**
     * @param int $wojewodztwo
     * @param string $miasto
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function aktualizujJesliMiastoNieIstnieje(int $wojewodztwo, string $miasto)
    {
        $istnieje = $this->findOneBy(['status' => 1, 'id_wojewodztwa' => $wojewodztwo, 'nazwa' => $miasto]);
        $dodano = false;
        if(empty($istnieje)){
            $miasto = new Miasto();
            $miasto->setIdWojewodztwa($wojewodztwo);
            $miasto->setNazwa($miasto);
            $miasto->setStatus(true);
            $this->_em->persist($miasto);
            $this->_em->flush();
            $dodano = true;
        }
        return $dodano;
    }

}
