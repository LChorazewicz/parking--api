<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.12.18
 * Time: 12:28
 */

namespace App\Library\Walidatory;


class NumerRejestracyjny implements WalidatorInterface
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
    private $wzorPoprawnejTablicy = "/^(([a-z]{2}[0-9]{1})|([a-z]{1}[0-9]{1,2})|([a-z]{1,3}))-[a-z0-9]{1,5}$/m";

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
        return preg_match($this->wzorPoprawnejTablicy[0], $this->wartosc);
    }
}