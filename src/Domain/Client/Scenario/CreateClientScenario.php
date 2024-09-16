<?php

declare(strict_types=1);

namespace App\Domain\Client\Scenario;

use App\Domain\Client\Model\Client;
use App\Domain\Client\Transformer\ClientTransformer;
use App\Infrastructure\Repository\ClientRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class CreateClientScenario
{
    public function __construct(
        private readonly ClientTransformer $clientTransformer,
        private readonly ClientRepository $clientRepository,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(Client $client): void
    {
        $this->logger->info('CreateClientScenario started');

        try {
            $clientEntity = $this->clientTransformer->transform($client);
            $this->clientRepository->create($clientEntity);
        } catch (Throwable $e) {
            $this->logger->error(sprintf('CreateClientScenario error: %s', $e->getMessage()));
            return;
        }

        $this->logger->info('CreateClientScenario success');
    }
}
