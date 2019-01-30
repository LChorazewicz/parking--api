<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.12.18
 * Time: 14:14
 */

namespace App\Library\Walidatory;


use App\DTO\Daty\DostepnoscDatIGodzin;

class DataIGodzina implements WalidatorInterface
{
    /**
     * @var string
     */
    private $wartosc;

    /**
     * @var array
     */
    private $daneDodatkowe;

    /**
     * @var string
     */
    private $wzor = '/^[a-z]{2,24}$/';

    /**
     * @param string $wartosc
     * @param array $daneDodatkowe
     */
    public function ustawWartosci(string $wartosc, array $daneDodatkowe = []): void
    {
        $this->wartosc = strtolower($wartosc);
        $this->daneDodatkowe = [];
    }

    /**
     * @return bool
     */
    public function sprawdzWynik(): bool
    {
        return preg_match($this->wzor, $this->wartosc);
    }
}