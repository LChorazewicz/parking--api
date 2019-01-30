<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 28.01.19
 * Time: 17:28
 */

namespace App\Library\Generatory;


class KodSms
{
    /**
     * @return string
     */
    public static function generuj()
    {
        return rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
    }
}