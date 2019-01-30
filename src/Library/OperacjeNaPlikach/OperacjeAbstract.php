<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 06.12.18
 * Time: 00:21
 */

namespace App\Library\OperacjeNaPlikach;


abstract class OperacjeAbstract
{
    static protected function zapiszTabliceDoPliku(string $plik, string $zawartosc)
    {
        self::zapisz($plik, $zawartosc);
    }

    static function zapisz(string $plik, string $zawartosc){

    }
}