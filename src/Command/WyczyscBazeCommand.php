<?php

namespace App\Command;

use App\Repository\KlienciRepository;
use App\Repository\KodyDostepoweRepository;
use App\Repository\TerminarzRepository;
use App\Repository\WnioskiHistoriaZmianStatusowRepository;
use App\Repository\WnioskiRepository;
use App\Repository\ZgodyOdpowiedziKlientaRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class WyczyscBazeCommand extends Command
{
    protected static $defaultName = 'app:wyczysc-baze';

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var WnioskiRepository
     */
    private $wnioski;

    /**
     * @var KodyDostepoweRepository
     */
    private $kody;

    /**
     * @var WnioskiHistoriaZmianStatusowRepository
     */
    private $historia;

    /**
     * @var ZgodyOdpowiedziKlientaRepository
     */
    private $zgody;

    /**
     * @var KlienciRepository
     */
    private $klienci;

    /**
     * @var TerminarzRepository
     */
    private $terminarz;

    /**
     * WyczyscBazeCommand constructor.
     * @param LoggerInterface $logger
     * @param WnioskiRepository $wnioskiRepository
     * @param KodyDostepoweRepository $kodyDostepoweRepository
     * @param WnioskiHistoriaZmianStatusowRepository $historiaZmianStatusowRepository
     * @param ZgodyOdpowiedziKlientaRepository $odpowiedziKlientaRepository
     * @param KlienciRepository $klienciRepository
     * @param TerminarzRepository $terminarzRepository
     */
    public function __construct(
        LoggerInterface $logger,
        WnioskiRepository $wnioskiRepository,
        KodyDostepoweRepository $kodyDostepoweRepository,
        WnioskiHistoriaZmianStatusowRepository $historiaZmianStatusowRepository,
        ZgodyOdpowiedziKlientaRepository $odpowiedziKlientaRepository,
        KlienciRepository $klienciRepository,
        TerminarzRepository $terminarzRepository)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->wnioski = $wnioskiRepository;
        $this->kody = $kodyDostepoweRepository;
        $this->historia = $historiaZmianStatusowRepository;
        $this->zgody = $odpowiedziKlientaRepository;
        $this->klienci = $klienciRepository;
        $this->terminarz = $terminarzRepository;
    }


    protected function configure()
    {
        $this
            ->setDescription('Komenda czyści tabele z wnioskami, statusami itp');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $this->logger->info("Rozpoczynam procedurę czyszczenia bazy");
        $odpowidz = $io->ask("Czy jesteś pewien, że chcesz wyczyścić CAŁĄ bazę danych? (tak/nie)");
        $this->logger->info("Zadałem pytanie potwiedzające");

        if($odpowidz == "tak"){
            $this->logger->info("Uzyskałem zgodę, rozpoczynam procedurę");
            $io->success("Uzyskałem zgodę, rozpoczynam procedurę...");

            try{
                $this->wnioski->usunWnioski();
                $this->kody->usunKody();
                $this->historia->usunHistorie();
                $this->zgody->usunZgody();
                $this->klienci->usunKientow();
                $this->terminarz->usunTerminy();
                $io->block("Procedura zakończona sukcesem");
            }catch (\Exception $e){
                $io->error("Wystąpił błąd " . $e->getMessage());
                $io->error($e->getMessage());
            }

            $io->success("Proces zakończony");
        }else{
            $this->logger->info("Nie uzyskałem satysfakcjonującej odpowiedzi");
            $io->warning("Anulowałem procedurę");
        }
    }
}
