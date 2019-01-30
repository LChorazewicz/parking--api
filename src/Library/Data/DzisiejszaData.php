<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 13.01.19
 * Time: 10:10
 */

namespace App\Library\Data;


use App\DTO\Daty\DataIGodzina;

class DzisiejszaData
{
    /**
     * @var string
     */
    private $data;

    /**
     * DzisiejszaData constructor.
     * @param string $dataSystemowa
     */
    public function __construct(string $dataSystemowa)
    {
        $this->data = $dataSystemowa;
    }

    /**
     * @param string $format
     * @return DataInterface
     * @throws \Exception
     */
    public function pobierz($format = DataIGodzina::class)
    {
        $dzis = new \DateTime($this->data);

        $dzisiejszaData = null;

        switch ($format) {
            case DataIGodzina::class:{
                $dzisiejszaData = new DataIGodzina(
                    $dzis->format('d'),
                    $dzis->format('m'),
                    $dzis->format('Y'),
                    $dzis->format('H')
                );
                break;
            }
        }

        return $dzisiejszaData;
    }
}