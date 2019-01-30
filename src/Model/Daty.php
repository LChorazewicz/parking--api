<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.12.18
 * Time: 14:05
 */

namespace App\Model;

use App\DTO\Adresy\SumaKontrolna;
use App\DTO\Daty\DostepnoscDatIGodzin;
use App\Library\Data\DataInterface;
use App\Library\Data\DzisiejszaData;
use App\Library\ZmienneSystemowe;
use App\Repository\TerminarzRepository;
use App\Repository\UstawieniaRepository;

class Daty
{
    /**
     * @var TerminarzRepository
     */
    private $terminarz;

    /**
     * @var UstawieniaRepository
     */
    private $ustawienia;

    /**
     * Daty constructor.
     * @param TerminarzRepository $terminarzRepository
     * @param UstawieniaRepository $ustawieniaRepository
     */
    public function __construct(TerminarzRepository $terminarzRepository, UstawieniaRepository $ustawieniaRepository)
    {
        $this->terminarz = $terminarzRepository;
        $this->ustawienia = $ustawieniaRepository;
    }
    /**
     * @param array $daty
     * @return bool
     * @throws \Exception
     */
    public function sprawdzPoprawnoscDat(array $daty)
    {
        /**
         * @var $dzisiejszaData DataInterface
         */
        $dzisiejszaData = (new DzisiejszaData($this->ustawienia->pobierzZmienna(ZmienneSystemowe::DATA_SYSTEMOWA)))->pobierz();

        /**
         * @var $dataIGodzinaRezerwacji DataInterface
         */
        foreach ($daty as $kluczGlowny => $dataIGodzinaRezerwacji){
            if(!$dataIGodzinaRezerwacji->jestWieksza($dzisiejszaData)){
                return false;
            }

            if(!$dataIGodzinaRezerwacji->jestWiekszaNiz($dzisiejszaData,
                $this->ustawienia->pobierzZmienna(ZmienneSystemowe::MAX_ILOSC_DNI_NA_REZERWACJE))){
                return false;
            }
        }
        return true;
    }

    /**
     * @param DostepnoscDatIGodzin $datyIGodziny
     * @param SumaKontrolna $adres
     * @return array
     * @desc: zwraca pustą tablicę, jeśli którakolwiek z podanych dat jest zajeta
     */
    public function sprawdzDostepnoscWybranychTerminow(DostepnoscDatIGodzin $datyIGodziny, SumaKontrolna $adres)
    {
        return $this->terminarz->sprawdzDostepnoscWybranychTerminow($datyIGodziny, $adres);
    }

    /**
     * @param DostepnoscDatIGodzin $datyIGodziny
     * @param SumaKontrolna $adres
     * @return bool
     */
    public function sprawdzAlternatywyWybranychTermonow(DostepnoscDatIGodzin $datyIGodziny, SumaKontrolna $adres)
    {
        return $this->terminarz->sprawdzDostepnoscWybranychTerminow($datyIGodziny, $adres);
    }
}