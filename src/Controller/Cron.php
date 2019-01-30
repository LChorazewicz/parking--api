<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 29.01.19
 * Time: 14:27
 */

namespace App\Controller;


use App\Entity\Wnioski;
use App\Model\Wniosek\Wniosek;
use App\Repository\KodyDostepoweRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class Cron extends ApiAbstract
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Wniosek
     */
    private $wnioski;

    /**
     * @var KodyDostepoweRepository
     */
    private $kody;

    /**
     * SprawdzController constructor.
     * @param LoggerInterface $logger
     * @param Wniosek $wnioski
     * @param KodyDostepoweRepository $kodyDostepoweRepository
     */
    public function __construct(LoggerInterface $logger, Wniosek $wnioski, KodyDostepoweRepository $kodyDostepoweRepository)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->wnioski = $wnioski;
        $this->kody = $kodyDostepoweRepository;
    }

    /**
     * @Rest\Route("/cron/przeterminuj-wnioski", name="przeterminuj")
     * @throws \Exception
     */
    public function przterminujWnioski()
    {
        /**
         * @var $wnioski Wnioski[]
         */
        $wnioski = $this->wnioski->pobierzWszystkiePrzeterminowaneWnioski();
        $przeterminowaneWnioski = [];
        foreach ($wnioski as $wniosek){
            $wniosek = $this->wnioski->przeterminujWniosek($wniosek->getId());
            $przeterminowaneWnioski[] = ['idWniosku' => $wniosek->getId(), 'nowyStatus' => $wniosek->getStatus()];
        }

        return new JsonResponse($przeterminowaneWnioski);
    }
}