<?php

namespace App\Controller;

use App\Library\WnioskiStatusy;
use App\Library\ZmienneSystemowe;
use App\Repository\UstawieniaRepository;
use App\Repository\WnioskiHistoriaZmianStatusowRepository;
use App\Repository\WnioskiRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthController
 * @package App\Controller
 * @Rest\Route("/auth", name="auth")
 */
class AuthController extends ApiAbstract
{
    /**
     * @var UstawieniaRepository
     */
    private $ustawienia;

    /**
     * @var WnioskiHistoriaZmianStatusowRepository
     */
    private $historiaZmianStatusow;

    /**
     * @var WnioskiRepository
     */
    private $wnioski;

    /**
     * AuthController constructor.
     * @param UstawieniaRepository $ustawieniaRepository
     * @param WnioskiHistoriaZmianStatusowRepository $historiaZmianStatusowRepository
     * @param WnioskiRepository $wnioskiRepository
     * @throws \ReflectionException
     */
    public function __construct(UstawieniaRepository $ustawieniaRepository, WnioskiHistoriaZmianStatusowRepository $historiaZmianStatusowRepository, WnioskiRepository $wnioskiRepository)
    {
        parent::__construct();
        $this->ustawienia = $ustawieniaRepository;
        $this->historiaZmianStatusow = $historiaZmianStatusowRepository;
        $this->wnioski = $wnioskiRepository;
    }

    /**
     * @Rest\Route("/czy-wymusic-restart-sesji/{idWniosku}", name="restart-sesji")
     * @param $idWniosku
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function czyWymusicRestartSesji($idWniosku)
    {
        $odpowiedz = false;
        $data = $this->ustawienia->pobierzZmienna(ZmienneSystemowe::DATA_RESTARTU_SESJI);
        $wniosek = $this->wnioski->pobierzWniosekPoIdWniosku($idWniosku);

        if($wniosek === null || $wniosek->getStatus() === WnioskiStatusy::PRZETERMINOWANY){
            $odpowiedz = true;
        }

        if($wniosek !== null && $wniosek->getDataWaznosci() <= (new \DateTime('now'))->format("d-m-Y H:i:s")){
            $odpowiedz = true;
            $this->wnioski->zmienStatusWniosku($wniosek->getId(), WnioskiStatusy::PRZETERMINOWANY);
        }

        if($wniosek !== null && $data !== null && !$odpowiedz){
            if($wniosek !== null){
                $historia = $this->historiaZmianStatusow->znajdzOstatni($wniosek->getId());
                if($historia !== null){
                    $dataZmiany = $historia->getDataZmiany();
                    if($dataZmiany <= $data){
                        $odpowiedz = true;
                        $this->wnioski->zmienStatusWniosku($wniosek->getId(), WnioskiStatusy::PRZETERMINOWANY);
                    }
                }
            }
        }
        $this->odpowiedz->przygotujZwrotke(['status' => $odpowiedz], Response::HTTP_OK, 0, false, [], ['idWnioskuApi' => $idWniosku]);

        return new JsonResponse($this->odpowiedz->pobierzOdpowiedz(), $this->odpowiedz->pobierzKodOdpowiedzi());
    }
}
