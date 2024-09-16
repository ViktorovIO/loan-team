<?php

namespace App\Presentation\Controller;

use App\Application\Client\ClientService;
use App\Presentation\Factory\ClientFactory;
use App\Presentation\Factory\ClientUpdateRequestFactory;
use App\Presentation\Request\CreateClientRequest;
use App\Presentation\Request\UpdateClientRequest;
use App\Presentation\Transformer\ClientTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class ClientController extends AbstractController
{
    public function __construct(
        private readonly ClientService $clientService,
        private readonly ClientTransformer $clientTransformer,
        private readonly ClientFactory $clientFactory,
        private readonly ClientUpdateRequestFactory $clientUpdateRequestFactory,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator,
    ) {}

    #[Route('/api/client/{id}', name: 'client_get', methods: 'GET')]
    public function get(int $id): Response
    {
        try {
            $client = $this->clientService->getById($id);
        } catch (Throwable $e) {
            return $this->json(sprintf('Get Client error: %s', $e->getMessage()), Response::HTTP_BAD_REQUEST);
        }

        if ($client === null) {
            return new Response('Client Not Found', 404);
        }

        return new JsonResponse(['client' => $this->clientTransformer->toArray($client)]);
    }

    #[Route('/api/client/create', name: 'client_create', methods: 'POST')]
    public function create(Request $request): Response
    {
        /** @var CreateClientRequest $createClientRequest */
        $createClientRequest = $this->serializer->deserialize(
            $request->getContent(),
            CreateClientRequest::class,
            'json'
        );

        $errors = $this->validator->validate($createClientRequest);
        if (count($errors) > 0) {
            return $this->json($this->formatErrors($errors), Response::HTTP_BAD_REQUEST);
        }

        try {
            $clientDTO = $this->clientFactory->make($createClientRequest);
            $this->clientService->create($clientDTO);
        } catch (Throwable $e) {
            return $this->json(sprintf('Create Client error: %s', $e->getMessage()), Response::HTTP_BAD_REQUEST);
        }

        return new Response('Client Created');
    }

    #[Route('/api/client/{id}', name: 'client_update', methods: 'PATCH')]
    public function update(int $id, Request $request): Response
    {
        // Находим клиента по ID
        $client = $this->clientService->getById($id);
        if ($client === null) {
            return new Response('Client Not Found', 404);
        }

        if (empty($request->getContent())) {
            return new Response('Update data is empty', 400);
        }

        /** @var UpdateClientRequest $updateClientRequest */
        $updateClientRequest = $this->serializer->deserialize(
            $request->getContent(),
            UpdateClientRequest::class,
            'json'
        );

        $errors = $this->validator->validate($updateClientRequest);
        if (count($errors) > 0) {
            return $this->json($this->formatErrors($errors), Response::HTTP_BAD_REQUEST);
        }

        $this->clientService->update(
            $this->clientUpdateRequestFactory->make($id, $updateClientRequest)
        );

        return new Response('Информация о клиенте обновлена');
    }

    private function formatErrors(ConstraintViolationListInterface $errors): array
    {
        $formattedErrors = [];
        foreach ($errors as $error) {
            $formattedErrors[] = [
                'field' => $error->getPropertyPath(),
                'message' => $error->getMessage(),
            ];
        }

        return $formattedErrors;
    }
}
