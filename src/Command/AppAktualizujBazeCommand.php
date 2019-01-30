<?php

namespace App\Command;

use App\Exception\BladZapisuException;
use App\Exception\PustaKolekcja;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use App\Model\Adresy;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppAktualizujBazeCommand extends Command
{
    protected static $defaultName = 'app:aktualizuj-baze';

    /**
     * @var Adresy
     */
    private $adresyModel;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $WSApi;

    /**
     * @var Client
     */
    private $guzzle;

    public function __construct(LoggerInterface $logger, Adresy $adresy, string $WSApi)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->adresyModel = $adresy;
        $this->WSApi = $WSApi;
        $this->guzzle = new Client();
    }
    protected function configure()
    {
        $this
            ->setDescription('Komenda automatycznie aktualizuje baze adresow - przyrostowo')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $this->logger->info('Rozpoczynam aktualizacje bazy adresow');
        $miejscowosci = 0;
        try{
            $wojewodztwa = $this->adresyModel->pobierzWojewodztwa();
            $wykonalemSie = 0;
            for($i = 0; $i <= 99; $i++){break;//aby czegos nie odpytalo 10k razy
                $pierwszaCzescKodu = $i;
                if($pierwszaCzescKodu <= 9){
                    $pierwszaCzescKodu = "0" . $i;
                }
                for($j = 1; $j <= 999; $j++){
                    $drugaCzescKodu = $j;
                    if (strlen($drugaCzescKodu) == 1){
                        $drugaCzescKodu = "0" . $j;
                    }

                    if (strlen($drugaCzescKodu) == 2){
                        $drugaCzescKodu = "00" . $j;
                    }

                    $kod = $pierwszaCzescKodu . '-' . $drugaCzescKodu;
                    $io->success($kod);
                    $odpowiedz = json_decode($this->guzzle->get($this->WSApi . $kod)->getBody()->getContents());
                    foreach ($odpowiedz as $rekord){
                        $idWojewodztwa = 0;
                        foreach ($wojewodztwa as $wojewodztwo) {
                            if($wojewodztwo->nazwa == $rekord->wojewodztwo){
                                $idWojewodztwa = $wojewodztwo->id;
                                break;
                            }
                        }
                        if($idWojewodztwa == 0){
                            break;
                        }
                        $wykonalemSie++;

                        if($this->adresyModel->dodajMiasto($idWojewodztwa, ucfirst(strtolower($rekord->miejscowosc)))){
                            $miejscowosci++;
                        }
                    }
                }
            }
        }catch (BladZapisuException $e){
            $this->logger->error($e->getMessage());
        } catch (PustaKolekcja $e) {
            $this->logger->error($e->getMessage());
        } catch (OptimisticLockException $e) {
            $this->logger->error($e->getMessage());
        } catch (ORMException $e) {
            $this->logger->error($e->getMessage());
        }
        $io->success('Baza danych zostala pomyslnie zaktualizowana');
        $io->success('Wykonałem się ' . $wykonalemSie . ' razy, zaktualizowano baze o ' . $miejscowosci . ' miast');
        $this->logger->info('Skonczylem aktualizacje bazy adresow');
    }
}
