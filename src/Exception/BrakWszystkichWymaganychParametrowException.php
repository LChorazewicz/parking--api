<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 25.12.18
 * Time: 11:47
 */

namespace App\Exception;


class BrakWszystkichWymaganychParametrowException extends ExceptionAbstract
{
    public function __construct()
    {
        parent::__construct();
        parent::ustawWiadomoscDlaKlienta(ExceptionAbstract::BRAK_WSZYSTKICH_WYMAGANYCH_PARAMETROW);
    }
}