<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 27.12.18
 * Time: 14:45
 */

namespace App\DTO\Daty;


use App\Exception\BladWstepnejWalidacjiDanychException;
use App\Library\Data\DataInterface;

class DataIGodzina implements DataInterface
{
    /**
     * @var int
     */
    private $dzien;

    /**
     * @var int
     */
    private $miesiac;

    /**
     * @var int
     */
    private $rok;

    /**
     * @var int
     */
    private $godzina;

    /**
     * DataIGodzina constructor.
     * @param int $dzien
     * @param int $miesiac
     * @param int $rok
     * @param int $godzina
     * @throws BladWstepnejWalidacjiDanychException
     * @throws \Exception
     */
    public function __construct(int $dzien, int $miesiac, int $rok, int $godzina)
    {
        if($dzien < 1 || $dzien > 31){
            throw new BladWstepnejWalidacjiDanychException();
        }

        if($miesiac < 1 || $miesiac > 12){
            throw new BladWstepnejWalidacjiDanychException();
        }

        $obecnyRok = (new \DateTime('now'))->format('Y');//todo: bede się przejmował w grudniu
        if($rok < $obecnyRok || $rok > $obecnyRok){
            throw new BladWstepnejWalidacjiDanychException();
        }

        if($godzina < 0 || $godzina > 23){
            throw new BladWstepnejWalidacjiDanychException();
        }

        $this->dzien = $dzien;
        $this->miesiac = $miesiac;
        $this->rok = $rok;
        $this->godzina = $godzina;
    }

    /**
     * @return int
     */
    public function pobierzDzien(): int
    {
        return $this->dzien;
    }

    /**
     * @return int
     */
    public function pobierzMiesiac(): int
    {
        return $this->miesiac;
    }

    /**
     * @return int
     */
    public function pobierzRok(): int
    {
        return $this->rok;
    }

    /**
     * @return int
     */
    public function pobierzGodzine(): int
    {
        return $this->godzina;
    }

    /**
     * @return string
     */
    public function __toString()
    {
       return $this->dzien . '-' . $this->miesiac . '-' . $this->rok;
    }

    /**
     * @param DataInterface $data
     * @return bool
     * @throws \Exception
     */
    public function jestWieksza(DataInterface $data): bool
    {
        $data1 = new \DateTime($this->pobierzRok() . '-' . $this->pobierzMiesiac() . '-' . $this->pobierzDzien() . ' ' . $this->pobierzGodzine() . ':00');
        $data2 = new \DateTime($data->pobierzRok() . '-' . $data->pobierzMiesiac() . '-' . $data->pobierzDzien() . ' ' . $data->pobierzGodzine() . ':00');
        return $data1->getTimestamp() > $data2->getTimestamp();
    }

    /**
     * @param DataInterface $data
     * @return bool
     */
    public function jestRowna(DataInterface $data): bool
    {
        return (
            $data->pobierzRok() === $this->pobierzRok() &&
            $data->pobierzMiesiac() === $this->pobierzMiesiac() &&
            $data->pobierzDzien() === $this->pobierzDzien() &&
            $data->pobierzGodzine() === $this->pobierzGodzine()
        );
    }

    /**
     * @param DataInterface $data
     * @param int $dni
     * @return bool
     * @throws \Exception
     */
    public function jestWiekszaNiz(DataInterface $data, int $dni)
    {
        $data1 = new \DateTime($this->pobierzRok() . '-' . $this->pobierzMiesiac() . '-' . $this->pobierzDzien() . ' ' . $this->pobierzGodzine() . ':00');
        $data2 = new \DateTime($data->pobierzRok() . '-' . $data->pobierzMiesiac() . '-' . $data->pobierzDzien() . ' ' . $data->pobierzGodzine() . ':00');
        $data2->modify('+' . $dni . 'days');
        return $data2->getTimestamp() > $data1->getTimestamp();
    }
}