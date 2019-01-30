<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 28.01.19
 * Time: 23:18
 */

namespace App\Model\Zgody;


use App\DTO\Zgody\ZgodyWejsciowe;
use App\Entity\ZgodyOdpowiedziKlienta;
use App\Exception\BrakWszystkichWymaganychParametrowException;

class Mapper
{
    /**
     * @param int $idWniosku
     * @param ZgodyWejsciowe[] $zgody
     * @return ZgodyOdpowiedziKlienta[]
     * @throws \Exception
     */
    public static function mapujZgodyDTONaEncje(int $idWniosku, array $zgody)
    {
        $daneWyjsciowe = [];
        foreach ($zgody as $zgoda){
            $encja = new ZgodyOdpowiedziKlienta();
            $encja->setDataDodania(new \DateTime('now'))
                ->setStatus(true)
                ->setIdWniosku($idWniosku)
                ->setIdZgody($zgoda->id)
                ->setOdpowiedz($zgoda->wartosc);
            $daneWyjsciowe[] = $encja;
        }
        return $daneWyjsciowe;
    }

    /**
     * @param array $zgody
     * @return array
     * @throws BrakWszystkichWymaganychParametrowException
     */
    public static function mapujZgodyWejsciowe(array $zgody)
    {
        $daneWyjsciowe = [];

        if(empty($zgody)){
            throw new BrakWszystkichWymaganychParametrowException();
        }

        foreach ($zgody as $zgoda){
            $dto = new ZgodyWejsciowe();
            if(!isset($zgoda->id) || !isset($zgoda->wartosc)){
                throw new BrakWszystkichWymaganychParametrowException();
            }
            $dto->id = $zgoda->id;
            $dto->wartosc = $zgoda->wartosc;
            $daneWyjsciowe[] = $dto;
        }

        return $daneWyjsciowe;
    }
}