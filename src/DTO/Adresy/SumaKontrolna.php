<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 20.01.19
 * Time: 16:02
 */

namespace App\DTO\Adresy;


use App\Exception\BladWstepnejWalidacjiDanychException;

class SumaKontrolna
{

    public $wojewodztwo;

    public $miasto;

    public $ulica;

    public $sumaKontrola;

    /**
     * SumaKontrolna constructor.
     * @param $suma
     * @throws BladWstepnejWalidacjiDanychException
     */
    public function __construct(string $suma)
    {
        $dane = explode("-", $suma);

        $czyPoprawny = true;

        if(!empty($dane) && count($dane) == 3){
            for($i = 0; $i <= 2; $i++){

                if(!$czyPoprawny){
                    break;
                }

                if(!isset($dane[$i]) || !is_numeric($dane[$i]) || intval($dane[$i]) < 1){
                    $czyPoprawny = false;
                    continue;
                }
            }
        }else{
            $czyPoprawny = false;
        }

        if(!$czyPoprawny){
            throw new BladWstepnejWalidacjiDanychException();
        }

        $this->wojewodztwo = $dane[0];
        $this->miasto = $dane[1];
        $this->ulica = $dane[2];
        $this->sumaKontrola = $suma;
    }
}