<?php
/**
 * Created by PhpStorm.
 * User: leszek
 * Date: 04.12.18
 * Time: 00:56
 */

namespace App\Controller;


use App\DTO\FinalResponseDTO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class ApiAbstract extends Controller
{
    /**
     * @var FinalResponseDTO
     */
    protected $odpowiedz;
//exit();
    /**
     * ApiAbstract constructor.
     */
    public function __construct()
    {
        $this->odpowiedz = new FinalResponseDTO();
    }
    /**
     * @param string $service
     * @return object
     */
    protected function getService(string $service)
    {
        return $this->container->get($service);
    }
}