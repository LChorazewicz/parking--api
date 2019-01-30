<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 05.12.18
 * Time: 23:28
 */

namespace App\Library\Logger;


use App\Library\OperacjeNaPlikach\OperacjeAbstract;

class StreamLogger extends OperacjeAbstract implements LoggerInterface
{
    public static function info(\Throwable $exception)
    {
        self::przygotujIZapisz($exception, debug_backtrace());
    }

    public static function error(\Throwable $exception)
    {
        self::przygotujIZapisz($exception, debug_backtrace());
    }

    public static function emergency(\Throwable $exception)
    {
        self::przygotujIZapisz($exception, debug_backtrace());
    }

    private static function przygotujIZapisz(\Throwable $e, $debugBacktrace)
    {
        $info = [
            'miejsce_zlapania_bledu' => [
                'plik' => $debugBacktrace[0]['file'],
                'linia' => $debugBacktrace[0]['line'],
                'klasa' => $debugBacktrace[1]['class'] . ':' . $debugBacktrace[1]['function']
            ],
            'tresc_z_excepszona' => [
                'wiadomosc' => $e->getMessage(),
                'plik' => $e->getFile(),
                'linia' => $e->getLine()
            ]
        ];

        $info = ['id' => 'unikalne_id', 'info' => $info];

        $lokalizacja = implode('/', explode('\\', $info['info']['miejsce_zlapania_bledu']['klasa']));

        self::zapiszTabliceDoPliku($lokalizacja, json_encode($info));
    }
}