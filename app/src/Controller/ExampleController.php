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

    #[Route('/api/login', name: 'api_login1', methods: ['POST'])]
    #[OA\Post(
        summary: 'Login to get JWT token',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'oznest@iua'),
                    new OA\Property(property: 'password', type: 'string', example: 'admin'),
                ],
                type: 'object'
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Returns JWT token',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'token', type: 'string', example: 'eyJhbGciOiJIUzI1...'),
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(response: 401, description: 'Invalid credentials'),
        ]
    )]
    public function apiLogin(): JsonResponse
    {
        return new JsonResponse(null, 401);
    }
}
