<?php
namespace App\Controller;

use App\Exception\ExceptionAbstract;
use App\Exception\WniosekNieIstniejeException;
use App\Model\Wniosek\Mapper;
use App\Model\Wniosek\Wniosek;
use FOS\RestBundle\Controller\Annotations as Rest;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WniosekController
 * @package App\Controller
 * @Rest\Route("/wniosek", name="wniosek")
 */
class WniosekController extends ApiAbstract
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Wniosek
     */
    private $wnioskiModel;

    /**
     * WniosekController constructor.
     * @param LoggerInterface $logger
     * @param Wniosek $wniosek
     */
    public function __construct(LoggerInterface $logger, Wniosek $wniosek)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->wnioskiModel = $wniosek;
    }

    /**
     * @Route("/stworz", name="wniosek", methods={"POST"})
     */
    public function ustalIdNowegoWniosku()
    {
        try {
            $wniosek = $this->wnioskiModel->stworzNowyWniosek();

            $this->odpowiedz->przygotujZwrotke(
                [
                    'idWnioskuApi' => $wniosek->getIdWniosku(),
                    'status' => $wniosek->getStatus()
                ], Response::HTTP_CREATED, 1, true, [],
                [
                    'idWnioskuApi' => $wniosek->getIdWniosku()
                ]);

        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Route("/aktualizuj", name="aktualizuj", methods={"PATCH"})
     * @param Request $request
     * @return JsonResponse
     */
    public function aktualizuj(Request $request)
    {
        try {
            $dane = json_decode($request->getContent());

            $wniosek = $this->wnioskiModel->aktualizujWniosekWedlugStatusuPoIdWniosku((array)$dane);
            $this->odpowiedz->przygotujZwrotke(['status' => $wniosek->getStatus()], Response::HTTP_OK, 1, false, (array)$dane, [
                'idWnioskuApi' => $wniosek->getIdWniosku()
            ]);
        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Route("/pobierz/{idWniosku}", name="pobierz", methods={"GET"})
     * @param $idWniosku
     * @return JsonResponse
     */
    public function pobierz($idWniosku)
    {
        try {
            $wniosek = $this->wnioskiModel->pobierzWniosekPoIdWniosku($idWniosku);
            if($wniosek === null){
                throw new WniosekNieIstniejeException();
            }
            $wniosekDTO = Mapper::zmapujEncjeNaDTO($wniosek);

            $this->odpowiedz->przygotujZwrotke([$wniosekDTO], Response::HTTP_OK, 1, true, ['idWnioskuApi' => $idWniosku], [
                'idWnioskuApi' => $wniosek->getIdWniosku()
            ]);
        } catch (WniosekNieIstniejeException $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_NO_CONTENT, ExceptionAbstract::WNIOSEK_NIE_ISTNIEJE, ['idWnioskuApi' => $idWniosku]);
            $this->logger->error($exception->getMessage());
        } catch (\Throwable $exception) {
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, ['idWnioskuApi' => $idWniosku]);
            $this->logger->error($exception->getMessage());
        } finally {
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }
}
