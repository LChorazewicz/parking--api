<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 28.01.19
 * Time: 22:40
 */

namespace App\Model\Wniosek;


use App\Entity\Klienci;
use App\Entity\Wnioski;
use App\Library\Generatory\Identyfikator;
use App\Library\WnioskiStatusy;
use App\Repository\KlienciRepository;
use App\Repository\KodyDostepoweRepository;
use App\Repository\WnioskiRepository;
use App\Repository\ZgodyOdpowiedziKlientaRepository;
use App\Service\SmsService;
use Psr\Log\LoggerInterface;

class Wniosek
{
    /**
     * @var WnioskiRepository
     */
    private $wnioskiRepositowy;

    /**
     * @var ZgodyOdpowiedziKlientaRepository
     */
    private $zgodyOdpowiedziKlienta;

    /**
     * @var KlienciRepository
     */
    private $klienciRepository;

    /**
     * @var KodyDostepoweRepository
     */
    private $kodSmsRepository;

    /**
     * @var SmsService
     */
    private $smsService;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Wniosek constructor.
     * @param LoggerInterface $logger
     * @param WnioskiRepository $wnioskiRepository
     * @param ZgodyOdpowiedziKlientaRepository $odpowiedziKlientaRepository
     * @param KlienciRepository $klienciRepository
     * @param KodyDostepoweRepository $kodyDostepoweRepository
     * @param SmsService $smsService
     */
    public function __construct(LoggerInterface $logger, WnioskiRepository $wnioskiRepository, ZgodyOdpowiedziKlientaRepository $odpowiedziKlientaRepository,
                                KlienciRepository $klienciRepository, KodyDostepoweRepository $kodyDostepoweRepository, SmsService $smsService)
    {
        $this->wnioskiRepositowy = $wnioskiRepository;
        $this->zgodyOdpowiedziKlienta = $odpowiedziKlientaRepository;
        $this->klienciRepository = $klienciRepository;
        $this->kodSmsRepository = $kodyDostepoweRepository;
        $this->smsService = $smsService;
        $this->logger = $logger;
    }

    /**
     * @throws \Exception
     */
    public function stworzNowyWniosek()
    {
        $wniosek = new Wnioski();
        $wniosek->setIdWniosku(Identyfikator::generuj())
            ->setStatus(WnioskiStatusy::WNIOSEK_KROK_1)
            ->setDataDodania((new \DateTime('now')))
            ->setDataWaznosci((new \DateTime('now'))->modify("+2 hours"))
            ->setIdKlienta(null)
            ->setImie(null)
            ->setNazwisko(null)
            ->setNumerRejestracyjny(null)
            ->setNumerTelefonu(null);

        $wniosek = $this->wnioskiRepositowy->dodajWniosek($wniosek);
        $this->wnioskiRepositowy->zmienDateWaznosciWniosku($wniosek->getId(), 2);
        return $wniosek;
    }

    /**
     * @param int $id
     * @param int $nowyStatus
     * @param $dane
     * @return Wnioski|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function aktualizujWniosekWedlugStatusu(int $id, int $nowyStatus, $dane)
    {
        $wniosek = $this->wnioskiRepositowy->pobierzWniosekPoId($id);

        if($wniosek->getStatus() === WnioskiStatusy::PRZETERMINOWANY){
            throw new \Exception("Próba nadpisania przeterminowanego wniosku id: " . $wniosek->getId());
        }

        switch ($nowyStatus){
            case WnioskiStatusy::PRZETERMINOWANY:{
                $this->wnioskiRepositowy->zmienStatusWniosku($id, $nowyStatus);
                $wniosek->setDataWaznosci(new \DateTime('now'));
                $this->wnioskiRepositowy->aktualizujWniosekApi($wniosek);
                $this->kodSmsRepository->dezaktywujKodySms($id);
                break;
            }
            case WnioskiStatusy::WNIOSEK_KROK_1:{
                $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                break;
            }
            case WnioskiStatusy::WNIOSEK_WALIDACJA_POPRAWNA_KROK_1:
            case WnioskiStatusy::WNIOSEK_BLAD_WALIDACJI_KROK_1:{
                if(!in_array($wniosek->getStatus(), [WnioskiStatusy::WNIOSEK_KROK_1, WnioskiStatusy::WNIOSEK_BLAD_WALIDACJI_KROK_1])){
                    $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                    break;
                }

                $this->wnioskiRepositowy->zmienStatusWniosku($id, $nowyStatus);
                $this->wnioskiRepositowy->zmienDateWaznosciWniosku($id, 2);
            break;
            }
            case WnioskiStatusy::WNIOSEK_WALIDACJA_POPRAWNA_KROK_2:{
                if(!in_array($wniosek->getStatus(), [WnioskiStatusy::WNIOSEK_KROK_2, WnioskiStatusy::WNIOSEK_BLAD_WALIDACJI_KROK_2])){
                    $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                    break;
                }
                $wniosek->setStatus($dane['nowyStatus'])
                    ->setNumerTelefonu($dane['numerTelefonu'])
                    ->setImie($dane['imie'])
                    ->setNazwisko($dane['nazwisko'])
                    ->setNumerRejestracyjny($dane['numerRejestracyjny']);
                $this->wnioskiRepositowy->aktualizujWniosekApi($wniosek);

                $this->zgodyOdpowiedziKlienta->dodajZgody(
                    \App\Model\Zgody\Mapper::mapujZgodyDTONaEncje($wniosek->getId(), $dane['zgody'])
                );

                $klient = new Klienci();
                $klient->setImie($dane['imie'])
                    ->setNazwisko($dane['nazwisko'])
                    ->setNumerTelefonu($dane['numerTelefonu'])
                    ->setDataDodania(new \DateTime('now'));

                $klient = $this->klienciRepository->stworzKlienta($klient);

                $wniosek->setIdKlienta($klient->getId());
                $this->wnioskiRepositowy->aktualizujWniosekApiBezWpisuDoHistorii($wniosek);

                $this->kodSmsRepository->dezaktywujKodySms($wniosek->getId());
                $this->wnioskiRepositowy->zmienDateWaznosciWniosku($id, 3);
                break;
            }
            case WnioskiStatusy::WNIOSEK_KROK_2:{
                if(!in_array($wniosek->getStatus(), [WnioskiStatusy::WNIOSEK_WALIDACJA_POPRAWNA_KROK_1])){
                    $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                    break;
                }
                $this->wnioskiRepositowy->zmienStatusWniosku($id, $nowyStatus);
                $this->wnioskiRepositowy->zmienDateWaznosciWniosku($id, 2);
                break;
            }
            case WnioskiStatusy::WNIOSEK_BLAD_WALIDACJI_KROK_2:{
                if(!in_array($wniosek->getStatus(), [WnioskiStatusy::WNIOSEK_KROK_2, WnioskiStatusy::WNIOSEK_BLAD_WALIDACJI_KROK_2])){
                    $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                    break;
                }
                $this->wnioskiRepositowy->zmienStatusWniosku($id, $nowyStatus);
                $this->wnioskiRepositowy->zmienDateWaznosciWniosku($id, 2);
                break;
            }
            case WnioskiStatusy::WNIOSEK_KROK_3:{
                if(!in_array($wniosek->getStatus(), [WnioskiStatusy::WNIOSEK_WALIDACJA_POPRAWNA_KROK_2])){
                    $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                    break;
                }
                $this->wnioskiRepositowy->zmienDateWaznosciWniosku($id, 2);
                $this->wnioskiRepositowy->zmienStatusWniosku($id, $nowyStatus);
                $kodSms = $this->kodSmsRepository->dodajKodSms($wniosek->getId(), 2);
                $this->smsService->wyslijKodDostepu($wniosek, $kodSms);
                break;
            }
            case WnioskiStatusy::WNIOSEK_WALIDACJA_POPRAWNA_KROK_3:{
                if(!in_array($wniosek->getStatus(), [WnioskiStatusy::WNIOSEK_BLAD_WALIDACJI_KROK_3, WnioskiStatusy::WNIOSEK_KROK_3])){
                    $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                    break;
                }
                $this->wnioskiRepositowy->zmienStatusWniosku($id, $nowyStatus);
                $this->wnioskiRepositowy->zmienDateWaznosciWniosku($id, 2);
                $this->kodSmsRepository->dezaktywujKodySms($id);
                break;
            }
            case WnioskiStatusy::WNIOSEK_BLAD_WALIDACJI_KROK_3:{
                if(!in_array($wniosek->getStatus(), [WnioskiStatusy::WNIOSEK_BLAD_WALIDACJI_KROK_3, WnioskiStatusy::WNIOSEK_KROK_3])){
                    $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                    break;
                }
                $this->wnioskiRepositowy->zmienStatusWniosku($id, $nowyStatus);
                $this->wnioskiRepositowy->zmienDateWaznosciWniosku($id, 2);

                $kodSms = $this->kodSmsRepository->dodajKodSms($wniosek->getId(), 2);
                $this->smsService->wyslijKodDostepu($wniosek, $kodSms);
                break;
            }
            case WnioskiStatusy::WNIOSEK_PODSUMOWANIE:{
                if(!in_array($wniosek->getStatus(), [WnioskiStatusy::WNIOSEK_WALIDACJA_POPRAWNA_KROK_3])){
                    $this->dodajInformacjeOProbieZmianyStatusu($wniosek->getId(), $wniosek->getStatus(), $nowyStatus);
                    break;

                }
                $wniosek->setDataWaznosci(new \DateTime('now'));
                $this->wnioskiRepositowy->aktualizujWniosekApiBezWpisuDoHistorii($wniosek);
                $this->wnioskiRepositowy->zmienStatusWniosku($id, $nowyStatus);
                break;
            }
            default:
                throw new \Exception("Wybrany status nie istnieje");
        }
        return $wniosek;
    }

    /**
     * @param array $dane
     * @return Wnioski|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function aktualizujWniosekWedlugStatusuPoIdWniosku(array $dane)
    {
        $wniosek = $this->wnioskiRepositowy->pobierzWniosekPoIdWniosku($dane['idWnioskuApi']);
        return $this->aktualizujWniosekWedlugStatusu($wniosek->getId(), $dane['nowyStatus'], $dane);
    }

    /**
     * @param $idWniosku
     * @return Wnioski|null
     */
    public function pobierzWniosekPoIdWniosku($idWniosku)
    {
        return $this->wnioskiRepositowy->pobierzWniosekPoIdWniosku($idWniosku);
    }

    /**
     * @param $idWniosku
     * @param $startStatus
     * @param $nowyStatus
     */
    private function dodajInformacjeOProbieZmianyStatusu($idWniosku, $startStatus, $nowyStatus){
        $this->logger->notice("Próba zmiany statusu", ['idWnioskuApi' => $idWniosku, 'startStatus' => $startStatus, 'nowyStatus' => $nowyStatus]);
    }

    /**
     * @return Wnioski
     * @throws \Exception
     */
    public function pobierzWszystkiePrzeterminowaneWnioski()
    {
        return $this->wnioskiRepositowy->pobierzPrzeterminowaneWnioski();
    }

    /**
     * @param $id
     * @return Wnioski|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function przeterminujWniosek($id)
    {
        return $this->aktualizujWniosekWedlugStatusu($id, WnioskiStatusy::PRZETERMINOWANY, []);
    }
}