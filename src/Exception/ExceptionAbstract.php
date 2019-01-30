<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 23.12.18
 * Time: 11:28
 */

namespace App\Exception;


abstract class ExceptionAbstract extends \Exception
{
    const BLAD_OGOLNY = 'Wystąpił błąd spójności danych';
    const BRAK_DANYCH = 'Brak danych dla żądania';
    const NIEZNANY_PARAMETR = 'Błąd poprawności parametrów';
    const BLAD_OPERACJI_NA_BAZIE = 'Błąd operacji na bazie';
    const BRAK_WSZYSTKICH_WYMAGANYCH_PARAMETROW = 'Brak wyszystkich wymaganych parametrow';
    const BLAD_WSTEPNEJ_WALIDACJI = 'Błąd wstępnej walidacji danych';
    const WNIOSEK_NIE_ISTNIEJE = 'Wniosek nie istnieje';

    /**
     * @var array
     */
    private $wiadomosci;

    /**
     * @param $wiadomosc
     */
    public function ustawWiadomoscDlaKlienta($wiadomosc){
        $this->wiadomosci[] = $wiadomosc;
    }

    /**
     * @return array
     */
    public function pobierzWiadomoscDlaKlienta(): array{
        return !empty($this->wiadomosci) ? $this->wiadomosci : [self::BLAD_OGOLNY];
    }

}