<?php

namespace App\Controller;

use App\Exception\ExceptionAbstract;
use App\Exception\NieznanyParametrException;
use App\Model\Adresy;
use FOS\RestBundle\Controller\Annotations as Rest;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdresyController
 * @package App\Controller
 * @Rest\Route("/adresy", name="adresy")
 */
class AdresyController extends ApiAbstract
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * AdresyController constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }
    /**
     * @Rest\Get("/wojewodztwa", name="wojewodztwa")
     */
    public function wojewodztwaAction()
    {
        try{
            /**
             * @var $wojewodztwaModel Adresy
             */
            $wojewodztwaModel = $this->get("App\Model\Adresy");
            $wojewodztwo = $wojewodztwaModel->pobierzWojewodztwa();
            $this->odpowiedz->przygotujZwrotke($wojewodztwo, Response::HTTP_OK, count($wojewodztwo), true, []);
        }catch (\Throwable $exception){
            $this->logger->error($exception->getMessage());
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
        }finally{
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Get("/miasta/{wojewodztwo}", name="miasta")
     */
    public function miastaAction($wojewodztwo)
    {
        try{

            if(intval($wojewodztwo) < 1){
                throw new NieznanyParametrException();
            }
            /**
             * @var $miastaModel Adresy
             */
            $miastaModel = $this->get("App\Model\Adresy");
            $miasta = $miastaModel->pobierzMiasta($wojewodztwo);
            $this->odpowiedz->przygotujZwrotke($miasta, Response::HTTP_OK, count($miasta), true, ['id_wojewodztwa' => intval($wojewodztwo)]);
        }catch (NieznanyParametrException $exception){
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, $exception->pobierzWiadomoscDlaKlienta(), ['id_wojewodztwa' => $wojewodztwo]);
        }catch (\Throwable $exception){
            $this->logger->error($exception->getMessage());
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
        }finally{
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }

    /**
     * @Rest\Get("/ulice/{idMiasta}", name="ulice")
     */
    public function ulice($idMiasta)
    {
        try{

            if(intval($idMiasta) < 1){
                throw new NieznanyParametrException();
            }
            /**
             * @var $uliceModel Adresy
             */
            $uliceModel = $this->get("App\Model\Adresy");
            $miasta = $uliceModel->pobierzUlice($idMiasta);
            $this->odpowiedz->przygotujZwrotke($miasta, Response::HTTP_OK, count($miasta), true, ['id_miasta' => intval($idMiasta)]);
        }catch (NieznanyParametrException $exception){
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, $exception->pobierzWiadomoscDlaKlienta(), ['id_miasta' => $idMiasta]);
        }catch (\Throwable $exception){
            $this->logger->error($exception->getMessage());
            $this->odpowiedz->przygotujZwrotkeZBledem([], Response::HTTP_BAD_REQUEST, ExceptionAbstract::BLAD_OGOLNY, []);
        }finally{
            return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
        }
    }
}
