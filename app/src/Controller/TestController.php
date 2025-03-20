<?php

namespace App\Controller;

use App\Services\Weather;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(
        private readonly Weather $weather
    ){}

    /**
     * @throws GuzzleException
     */
    #[Route('/weather/{city}', name: 'app_test')]
    public function index(?string $city = null): Response
    {
        $weather = $this->weather->getWeatherByCity($city);

        return $this->render('weather/index.html.twig', [
            'weather' => $weather,
            'city' => $city
        ]);
    }
}
