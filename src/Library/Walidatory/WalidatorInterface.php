<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.12.18
 * Time: 12:29
 */

namespace App\Library\Walidatory;


interface WalidatorInterface
{
    public function ustawWartosci(string $wartosc, array $daneDodatkowe = []): void;

    public function sprawdzWynik(): bool;
}