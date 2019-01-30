<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 13.01.19
 * Time: 10:15
 */

namespace App\Library\Data;


interface DataInterface
{
    public function pobierzDzien(): int;
    public function pobierzMiesiac(): int;
    public function pobierzRok(): int;
    public function pobierzGodzine(): int;
    public function jestWieksza(DataInterface $data): bool;
    public function jestRowna(DataInterface $data): bool;
    public function jestWiekszaNiz(DataInterface $dzisiejszaData, int $dni);
}