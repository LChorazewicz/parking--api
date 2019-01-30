<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 04.12.18
 * Time: 00:24
 */

namespace App\Model;


use App\DTO\Adresy\Miasta;
use App\DTO\Adresy\Wojewodztwa;
use App\Repository\MiastoRepository;
use App\Repository\UlicaRepository;
use App\Repository\V_AdresSumaKontrolnaRepository;
use App\Repository\WojewodztwoRepository;


class Adresy
{
    /**
     * @var WojewodztwoRepository
     */
    private $wojewodztwa;

    /**
     * @var MiastoRepository
     */
    private $miasta;

    /**
     * @var UlicaRepository
     */
    private $ulice;

    /**
     * @var V_AdresSumaKontrolnaRepository
     */
    private $sumaKontrolna;

    public function __construct(WojewodztwoRepository $wojewodztwoRepository, MiastoRepository $miastoRepository, UlicaRepository $ulicaRepository,
                                V_AdresSumaKontrolnaRepository $adresSumaKontrolnaRepository)
    {
        $this->wojewodztwa = $wojewodztwoRepository;
        $this->miasta = $miastoRepository;
        $this->ulice = $ulicaRepository;
        $this->sumaKontrolna = $adresSumaKontrolnaRepository;
    }

    /**
     * @return Wojewodztwa[]
     */
    public function pobierzWojewodztwa()
    {
        $wojewodztwa = $this->wojewodztwa->pobierzWszystkieWojewodztwa();
        $dtoCollection = [];
        foreach ($wojewodztwa as $wojewodztwo){
            $dto = new Wojewodztwa();
            $dto->id = $wojewodztwo->getId();
            $dto->nazwa = ucfirst(strtolower($wojewodztwo->getNazwa()));
            $dtoCollection[] = $dto;
        }

        return $dtoCollection;
    }

    /**
     * @param $idWojewodztwa
     * @return array
     */
    public function pobierzMiasta($idWojewodztwa)
    {
        $miasta = $this->miasta->pobierzWszystkieMiasta($idWojewodztwa);
        $dtoCollection = [];
        foreach ($miasta as $miasto){
            $dto = new Miasta();
            $dto->id = $miasto->getId();
            $dto->nazwa = ucfirst(strtolower($miasto->getNazwa()));
            $dtoCollection[] = $dto;
        }

        return $dtoCollection;
    }

    /**
     * @param $idMiasta
     * @return array
     */
    public function pobierzUlice($idMiasta)
    {
        $miasta = $this->ulice->pobierzWszystkieUlice($idMiasta);
        $dtoCollection = [];
        foreach ($miasta as $miasto){
            $dto = new Miasta();
            $dto->id = $miasto->getId();
            $dto->nazwa = ucfirst(strtolower($miasto->getNazwa()));
            $dtoCollection[] = $dto;
        }

        return $dtoCollection;
    }

    /**
     * @param int $wojewodztwo
     * @param string $miasto
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function dodajMiasto(int $wojewodztwo, string $miasto)
    {
        return $this->miasta->aktualizujJesliMiastoNieIstnieje($wojewodztwo, $miasto);
    }

    /**
     * @param $sumaKontrolna
     * @return bool
     */
    public function sprawdzAdres($sumaKontrolna)
    {
        return $this->sumaKontrolna->sprawdzCzySumaKontrolnaIstnieje($sumaKontrolna);
    }
}