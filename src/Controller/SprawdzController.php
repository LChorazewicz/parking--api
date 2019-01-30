<?php

namespace App\Controller;

use App\DTO\Adresy\SumaKontrolna;
use App\DTO\Daty\DostepnoscDatIGodzin;
use App\DTO\Zgody\ZgodyWejsciowe;
use App\Entity\Zgody;
use App\Exception\BladWstepnejWalidacjiDanychException;
use App\Exception\BrakWszystkichWymaganychParametrowException;
use App\Exception\ExceptionAbstract;
use App\Exception\WniosekNieIstniejeException;
use App\Library\Walidatory\Imie;
use App\Library\Walidatory\Nazwisko;
use App\Library\Walidatory\NumerRejestracyjny;
use App\Library\Walidatory\NumerTelefonu;
use App\Model\Adresy;
use App\Model\Daty;
use App\Repository\KodyDostepoweRepository;
use App\Repository\WnioskiRepository;
use App\Repository\ZgodyRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SprawdzController
 * @package App\Controller
 * @Rest\Route("/sprawdz", name="sprawdz")
 */
class SprawdzController extends ApiAbstract
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Adresy
     */
    private $adresyModel;

    /**
     * @var Daty
     */
    private $datyModel;

    /**
     * SprawdzController constructor.
     * @param LoggerInterface $logger
     * @param Adresy $adresy
     * @param Daty $daty
     */
    public function __construct(LoggerInterface $logger, Adresy $adresy, Daty $daty)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->adresyModel = $adresy;
        $this->datyModel = $daty;
    }

    /**
     * @Rest\Route("/adres/suma-kontrolna/{sumaKontrolna}", name="sprawdz-adres", methods={"GET"})
     * @param $sumaKontrolna
     * @return JsonResponse
     */
    public function adresAction($sumaKontrolna)
    {
        try {
            if (strlen($sumaKontrolna) <= 1) {
                throw new BrakWszystkichWymaganychParametrowException();
            }
            $wynik = $this->adresyModel->sprawdzAdres($sumaKontrolna);
            $this->odpowiedz->przygotujZwrotke(['status' => $wynik], Response::HTTP_OK, 0, false, $sumaKontrolna);
        } catch (BrakWszystkichWymaganychParametrowException $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem(
                [ExceptionAbstract::BRAK_WSZYSTKICH_WYMAGANYCH_PARAMETROW, 'suma_kontrolna'],
                Response::HTTP_NOT_ACCEPTABLE,
                ExceptionAbstract::BRAK_WSZYSTKICH_WYMAGANYCH_PARAMETROW, []);
        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Route("/numer_rejestracyjny/{numerRejestracyjny}", name="sprawdz-rejestracje", methods={"GET"})
     * @param $numerRejestracyjny
     * @return JsonResponse
     */
    public function rejestracjaAction($numerRejestracyjny)
    {
        try {

            $wynik = new NumerRejestracyjny();
            $wynik->ustawWartosci($numerRejestracyjny);
            $this->odpowiedz->przygotujZwrotke(['status' => $wynik->sprawdzWynik()], Response::HTTP_OK, 0, false, $numerRejestracyjny);

        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Route("/imie/{imie}", name="sprawdz-imie", methods={"GET"})
     * @param $imie
     * @return JsonResponse
     */
    public function imieAction($imie)
    {
        try {

            $wynik = new Imie();
            $wynik->ustawWartosci(strval($imie));
            $this->odpowiedz->przygotujZwrotke(['status' => $wynik->sprawdzWynik()], Response::HTTP_OK, 0, false, $imie);

        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Route("/nazwisko/{nazwisko}", name="sprawdz-nazwisko", methods={"GET"})
     * @param $nazwisko
     * @return JsonResponse
     */
    public function nazwiskoAction($nazwisko)
    {
        try {

            $wynik = new Nazwisko();
            $wynik->ustawWartosci($nazwisko);
            $this->odpowiedz->przygotujZwrotke(['status' => $wynik->sprawdzWynik()], Response::HTTP_OK, 0, false, $nazwisko);

        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Route("/numer_telefonu/{telefon}", name="sprawdz-telefon", methods={"GET"})
     * @param $telefon
     * @return JsonResponse
     */
    public function telefonAction($telefon)
    {
        try {

            $wynik = new NumerTelefonu();
            $wynik->ustawWartosci($telefon);
            $this->odpowiedz->przygotujZwrotke(['status' => $wynik->sprawdzWynik()], Response::HTTP_OK, 0, false, $telefon);

        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Route("/kod-sms/{kodSms}/idWnioskuApi/{idWniosku}", name="sprawdz-kod-sms", methods={"GET"})
     * @param $idWniosku
     * @param $kodSms
     * @param KodyDostepoweRepository $kodyDostepoweRepository
     * @param WnioskiRepository $wnioskiRepository
     * @return JsonResponse
     */
    public function smsAction($kodSms, $idWniosku, KodyDostepoweRepository $kodyDostepoweRepository, WnioskiRepository $wnioskiRepository)
    {
        try {
            $wniosek = $wnioskiRepository->pobierzWniosekPoIdWniosku($idWniosku);

            if(empty($wniosek)){
                throw new WniosekNieIstniejeException();
            }

            $kod = $kodyDostepoweRepository->pobierzKodDostepu($wniosek->getId(), $kodSms);

            $this->odpowiedz->przygotujZwrotke(['status' => !empty($kod)], Response::HTTP_OK, 0, false, ['idWniosku' => $idWniosku, 'kod' => $kodSms]);

        }catch (WniosekNieIstniejeException $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::WNIOSEK_NIE_ISTNIEJE, ['idWniosku' => $idWniosku, 'kod' => $kodSms]);
            $this->logger->error($exception->getMessage());
        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Route("/daty", name="sprawdz-daty", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function datyAction(Request $request)
    {
        try {
            $wynik = false;

            /**
             * @note: {
               "0": {
                    "dzien": 1,
                    "miesiac": 2,
                    "rok": 2018,
                    "godzina": 21,
                    "adres": "1-1-1"
                },
                "1":{
                    "dzien": 2,
                    "miesiac": 2,
                    "rok": 2018,
                    "godzina": 21,
                    "adres": "1-1-1"
                }
               }
             */
            $datyIGodziny = json_decode($request->getContent());
            if (empty($datyIGodziny)) {
                throw new BrakWszystkichWymaganychParametrowException();
            }

            $kolekcjaDatIGodzin = new DostepnoscDatIGodzin();
            $kolekcjaDatIGodzin->ustawKolekcjeDatIGodzin($datyIGodziny);

            $wynikWalidacji = $this->datyModel->sprawdzPoprawnoscDat($kolekcjaDatIGodzin->pobierzKolekcje());

            if (!$wynikWalidacji) {
                throw new BladWstepnejWalidacjiDanychException();
            }

            $adres = new SumaKontrolna($datyIGodziny->{0}->adres);

            $dostepnoscWybranychTerminow = $this->datyModel->sprawdzDostepnoscWybranychTerminow($kolekcjaDatIGodzin, $adres);

            if($dostepnoscWybranychTerminow){
                $wynik = true;
            }

            if (!$wynik && $dostepnoscWybranychTerminow) {
                $dostepnoscWybranychTerminow = $this->datyModel->sprawdzAlternatywyWybranychTermonow($kolekcjaDatIGodzin, $adres);
            }

            if (!$wynik && $dostepnoscWybranychTerminow) {
                $wynik = false;
            }

            $this->odpowiedz->przygotujZwrotke(['status' => $wynik], Response::HTTP_OK, 0, false, $datyIGodziny);
        } catch (BrakWszystkichWymaganychParametrowException $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem(
                [ExceptionAbstract::BRAK_WSZYSTKICH_WYMAGANYCH_PARAMETROW, 'daty'],
                Response::HTTP_NOT_ACCEPTABLE,
                ExceptionAbstract::BRAK_WSZYSTKICH_WYMAGANYCH_PARAMETROW, []);
        } catch (BladWstepnejWalidacjiDanychException $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem(
                [ExceptionAbstract::BLAD_WSTEPNEJ_WALIDACJI],
                Response::HTTP_NOT_ACCEPTABLE,
                ExceptionAbstract::BLAD_WSTEPNEJ_WALIDACJI, []);
        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Route("/zgody", name="sprawdz-zgody", methods={"POST"})
     * @param Request $request
     * @param ZgodyRepository $zgodyRepository
     * @return JsonResponse
     */
    public function zgodyAction(Request $request, ZgodyRepository $zgodyRepository)
    {
        /**
         * @note: {
        "0": {
        "id": 1,
        "wartosc": 1
        },
        "1":{
        "id": 2,
        "wartosc": 1
        },
        "2":{
        "id": 3,
        "wartosc": 1
        },
        "3":{
        "id": 4,
        "wartosc": 1
        }
        }
         */

        try {
            $daneWejsciowe = json_decode($request->getContent());
            if (empty($daneWejsciowe)) {
                throw new BrakWszystkichWymaganychParametrowException();
            }

            /**
             * @var ZgodyWejsciowe[] $zgodyKlienta
             */
            $zgodyKlienta = \App\Model\Zgody\Mapper::mapujZgodyWejsciowe($daneWejsciowe);

            /**
             * @var Zgody[] $zgodyZBazy
             */
            $zgodyZBazy = $zgodyRepository->pobierzZgody();

            $zgodyModel = new \App\Model\Zgody();
            $wynik = $zgodyModel->sprawdzZgody($zgodyZBazy, $zgodyKlienta);
            $this->odpowiedz->przygotujZwrotke(['status' => $wynik], Response::HTTP_OK, 0, false, $daneWejsciowe);

        }catch (BrakWszystkichWymaganychParametrowException $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem(
                [ExceptionAbstract::BRAK_WSZYSTKICH_WYMAGANYCH_PARAMETROW, 'zgody'],
                Response::HTTP_NOT_ACCEPTABLE,
                ExceptionAbstract::BRAK_WSZYSTKICH_WYMAGANYCH_PARAMETROW, []);
        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

}
