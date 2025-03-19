<?php

namespace App\Controller;

use App\Form\CityForm;
use App\Services\Weather;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{

    public function __construct(
        private Weather $weather
    ){}


    #[Route('/weather/{city}', name: 'app_test')]
    public function index(Request $request, string $city): Response
    {
        $weather = $this->weather->getWeatherByCity($city);
        $city = $city ?? null;

        return $this->render('weather/index.html.twig', [
            'weather' => $weather ?? null,
            'city' => $city
        ]);
    }

    private function getWeatherData($city) {
        $apiKey = '05a5ee0c29f54dd5a06225644251703';
        $url = "https://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$city}";
        dump($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            $error = 'Curl error: ' . curl_error($ch);
            curl_close($ch);
            return ['error' => $error];
        }

        curl_close($ch);
        $data = json_decode($response, true);

        if(isset($data['error'])) {
            return ['error' => $data['error']['message']];
        }

        $result = [
            'city' => $data['location']['name'],
            'country' => $data['location']['country'],
            'temperature' => $data['current']['temp_c'],
            'condition' => $data['current']['condition']['text'],
            'humidity' => $data['current']['humidity'],
            'wind_speed' => $data['current']['wind_kph'],
            'last_updated' => $data['current']['last_updated'],
        ];

        file_put_contents('weather_log.txt', date('Y-m-d H:i:s') . " - Погода в {$result['city']}: {$result['temperature']}°C, {$result['condition']}\n", FILE_APPEND);

        return $result;
    }
}
