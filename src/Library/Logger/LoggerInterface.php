<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 06.12.18
 * Time: 00:09
 */

namespace App\Library\Logger;


interface LoggerInterface
{
    public static function info(\Throwable $e);

    public static function error(\Throwable $e);

    public static function emergency(\Throwable $e);
}