<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.12.18
 * Time: 14:57
 */

namespace App\DTO\Daty;


class DostepnoscDatIGodzin
{
    /**
     * @var array
     */
    private $kolekcja = [];

    /**
     * @param \stdClass $datyIGodziny
     * @throws \App\Exception\BladWstepnejWalidacjiDanychException
     */
    public function ustawKolekcjeDatIGodzin(\stdClass $datyIGodziny)
    {
        $kolekcja = [];
        foreach ($datyIGodziny as $kluczGlowny => $dataIGodzina){
                $kolekcja[$kluczGlowny] = new DataIGodzina(
                    intval($dataIGodzina->dzien),
                    intval($dataIGodzina->miesiac),
                    intval($dataIGodzina->rok),
                    intval($dataIGodzina->godzina)
                );
        }
        $this->kolekcja = $kolekcja;
    }

    /**
     * @return array
     */
    public function pobierzKolekcje()
    {
        return $this->kolekcja;
    }

    /**
     * @return DataIGodzina[]
     */
    public function pogrupujKolekcje()
    {
        $pogrupowanaKolekcja = [];

        /**
         * @var $data DataIGodzina
         */
        foreach ($this->kolekcja as $data){
            $pogrupowanaKolekcja[$data->__toString()][] = $data;
        }

        return $pogrupowanaKolekcja;
    }
}