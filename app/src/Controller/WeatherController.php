<?php

namespace App\Controller;

use App\Services\Weather;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use \Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class WeatherController extends AbstractController
{
    public function __construct(
        private readonly Weather $weather,
        private MailerInterface $mailer
    ){}

    /**
     * @throws GuzzleException
     */
    #[Route('/weather/{city}', name: 'city_weather')]
    public function index(?string $city = null): Response
    {
        $email = (new Email())
            ->from('test@example.com')
            ->to('recipient@example.com')
            ->subject('Test Email')
            ->text('This is a test email.');

        $this->mailer->send($email);
        try{
            $weather = $this->weather->getWeatherByCity($city);

            return $this->render('weather/index.html.twig', [
                'weather' => $weather,
                'city' => $city
            ]);
        } catch (GuzzleException $e) {
            return $this->render('weather/error.html.twig', ['message' => $e->getMessage()]);
        }
    }
}
