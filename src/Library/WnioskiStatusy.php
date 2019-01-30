<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 28.01.19
 * Time: 00:10
 */

namespace App\Library;


class WnioskiStatusy
{
    public const WNIOSEK_KROK_1 = 10;

    public const WNIOSEK_BLAD_WALIDACJI_KROK_1 = 11;

    public const WNIOSEK_WALIDACJA_POPRAWNA_KROK_1 = 12;

    public const WNIOSEK_KROK_2 = 20;

    public const WNIOSEK_BLAD_WALIDACJI_KROK_2 = 21;

    public const WNIOSEK_WALIDACJA_POPRAWNA_KROK_2 = 22;

    public const WNIOSEK_KROK_3 = 30;

    public const WNIOSEK_BLAD_WALIDACJI_KROK_3 = 31;

    public const WNIOSEK_WALIDACJA_POPRAWNA_KROK_3 = 32;

    public const WNIOSEK_PODSUMOWANIE = 40;

    public const PRZETERMINOWANY = 50;
}