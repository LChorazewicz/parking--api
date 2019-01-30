<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 23.12.18
 * Time: 21:20
 */

namespace App\Exception;


class WniosekNieIstniejeException extends ExceptionAbstract
{
    public function __construct()
    {
        parent::__construct();
        parent::ustawWiadomoscDlaKlienta(ExceptionAbstract::WNIOSEK_NIE_ISTNIEJE);
    }
}