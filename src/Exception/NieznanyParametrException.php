<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 23.12.18
 * Time: 11:31
 */

namespace App\Exception;


class NieznanyParametrException extends ExceptionAbstract
{
    public function __construct()
    {
        parent::__construct();
        parent::ustawWiadomoscDlaKlienta(ExceptionAbstract::NIEZNANY_PARAMETR);
    }
}