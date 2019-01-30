<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 28.01.19
 * Time: 22:43
 */

namespace App\Model\Wniosek;

use App\Entity\Wnioski;

class Mapper
{
    public static function zmapujWniosekDTONaEncje(\App\DTO\Wniosek\Wniosek $dto)
    {
        $wniosekApi = new Wnioski();
        $wniosekApi
            ->setStatus($dto->status)
            ->setNumerTelefonu($dto->numerTelefonu)
            ->setImie($dto->imie)
            ->setNazwisko($dto->nazwisko)
            ->setNumerRejestracyjny($dto->numerRejestracyjny)
            ->setIdWniosku($dto->idWnioskuApi);
        return $wniosekApi;
    }

    public static function zmapujEncjeNaDTO(Wnioski $wniosek)
    {
        $dto = new \App\DTO\Wniosek\Wniosek();
        $dto->idWnioskuApi = $wniosek->getIdWniosku();
        $dto->idKlienta = $wniosek->getIdKlienta();
        $dto->status = $wniosek->getStatus();
        $dto->numerTelefonu = $wniosek->getNumerTelefonu();
        $dto->imie = $wniosek->getImie();
        $dto->nazwisko = $wniosek->getNazwisko();
        $dto->numerRejestracyjny = $wniosek->getNumerRejestracyjny();
        return $dto;
    }
}