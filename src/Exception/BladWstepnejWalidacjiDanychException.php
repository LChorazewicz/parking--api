<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.12.18
 * Time: 14:32
 */

namespace App\Exception;


class BladWstepnejWalidacjiDanychException extends ExceptionAbstract
{
    public function __construct()
    {
        parent::__construct();
        parent::ustawWiadomoscDlaKlienta(ExceptionAbstract::BLAD_WSTEPNEJ_WALIDACJI);
    }
}