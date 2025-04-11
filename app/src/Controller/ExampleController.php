<?php
declare(strict_types=1);

namespace App\Controller;


use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ExampleController extends AbstractController
{
    #[Route('/api/example', name: 'api_example', methods: ['GET'])]
    #[OA\Get(
        path: "/api/example",
        description: "Возвращает тестовый JSON",
        summary: "Получение примера",
        responses: [
            new OA\Response(
                response: 200,
                description: "Успешный ответ",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Hello, API!")
                    ],
                    type: "object"
                )
            )
        ]
    )]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function example(): JsonResponse
    {
        return $this->json(['message' => 'Hello, API!']);
    }
}