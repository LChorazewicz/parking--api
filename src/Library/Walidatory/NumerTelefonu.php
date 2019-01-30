<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.12.18
 * Time: 12:28
 */

namespace App\Library\Walidatory;


class NumerTelefonu implements WalidatorInterface
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
    private $wzor = '/^([5-8]{1}[0-9]{2})-[0-9]{3}-[0-9]{3}$/';

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