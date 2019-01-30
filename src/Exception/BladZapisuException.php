<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 23.12.18
 * Time: 21:20
 */

namespace App\Exception;


class BladZapisuException extends ExceptionAbstract
{
    public function __construct()
    {
        parent::__construct();
        parent::ustawWiadomoscDlaKlienta(ExceptionAbstract::BLAD_OPERACJI_NA_BAZIE);
    }
}