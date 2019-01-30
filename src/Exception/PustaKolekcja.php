<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 23.12.18
 * Time: 14:20
 */

namespace App\Exception;


class PustaKolekcja extends ExceptionAbstract
{
    public function __construct()
    {
        parent::__construct();
        parent::ustawWiadomoscDlaKlienta(ExceptionAbstract::BRAK_DANYCH);
    }
}