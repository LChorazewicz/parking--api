<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.01.19
 * Time: 10:10
 */

namespace App\Library\Generatory;


use Ramsey\Uuid\Uuid;

class Identyfikator
{
    /**
     * @throws \Exception
     */
    public static function generuj()
    {
        return Uuid::uuid4()->toString();
    }
}