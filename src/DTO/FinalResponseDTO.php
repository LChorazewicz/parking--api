<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 23.12.18
 * Time: 10:40
 */

namespace App\DTO;

use Symfony\Component\HttpFoundation\Response;

class FinalResponseDTO implements FinalResponseDTOInterface
{
    /**
     * @var array
     */
    private $odpowiedz = [];

    /**
     * @var int
     */
    private $kodOdpowiedzi;

    /**
     * @param array $kolekcja
     * @param int $kodOdpowiedzi
     * @param int $ilosc
     * @param bool $czyWyswietlacIlosc
     * @param array $daneWejsciowe
     * @param array $daneDodatkowe
     */
    public function przygotujZwrotke(array $kolekcja, $kodOdpowiedzi = Response::HTTP_OK, $ilosc = 0, $czyWyswietlacIlosc = false, $daneWejsciowe = [], $daneDodatkowe = [])
    {
        $odpowiedz = [];

        if(!empty($daneWejsciowe)){
            $odpowiedz['meta']['dane_wejsciowe'] = $daneWejsciowe;
        }

        if(!empty($daneDodatkowe) && isset($daneDodatkowe['idWnioskuApi'])){
            $odpowiedz['meta']['id_wniosku_api'] = $daneDodatkowe['idWnioskuApi'];
        }

        if($ilosc > 0 && $czyWyswietlacIlosc){
            $odpowiedz['meta']['ilosc'] = $ilosc;
        }

        $odpowiedz['meta']['kod_odpowiedzi'] = $kodOdpowiedzi;

        if(!empty($kolekcja)){
            $odpowiedz['dane'] = $kolekcja;
        }

        $this->odpowiedz = $odpowiedz;
        $this->kodOdpowiedzi = $kodOdpowiedzi;
    }

    /**
     * @param array $kolekcjaBledow
     * @param int $kodOdpowiedzi
     * @param string $opisOgolnyBledu
     * @param array $daneWejsciowe
     */
    public function przygotujZwrotkeZBledem(array $kolekcjaBledow, $kodOdpowiedzi = Response::HTTP_BAD_REQUEST, $opisOgolnyBledu = '', $daneWejsciowe = [])
    {
        $odpowiedz = [];//todo: sprawdzić dlaczego jeśli $kolekcjaBledow jest ustawniona to sie ustawia index za duzo

        $odpowiedz['meta']['kod_odpowiedzi'] = $kodOdpowiedzi;

        if(!empty($daneWejsciowe)){
            $odpowiedz['meta']['dane_wejsciowe'] = $daneWejsciowe;
        }

        if(strlen($opisOgolnyBledu) > 1){
            $odpowiedz['meta']['opis_ogolny_bledu'] = $opisOgolnyBledu;
        }

        if(!empty($kolekcjaBledow)){
            $odpowiedz['bledy'] = $kolekcjaBledow;
        }elseif(strlen($odpowiedz['meta']['opis_ogolny_bledu']) > 1){
            $odpowiedz['bledy'] = [$odpowiedz['meta']['opis_ogolny_bledu']];
        }

        $this->odpowiedz = $odpowiedz;
        $this->kodOdpowiedzi = $kodOdpowiedzi;

    }

    /**
     * @return array
     */
    public function pobierzOdpowiedz()
    {
        return $this->odpowiedz;
    }

    /**
     * @return int
     */
    public function pobierzKodOdpowiedzi()
    {
        return $this->kodOdpowiedzi;
    }
}