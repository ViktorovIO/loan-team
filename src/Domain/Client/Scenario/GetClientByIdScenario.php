<?php

declare(strict_types=1);

namespace App\Domain\Client\Scenario;

use App\Domain\Client\Model\Client;
use App\Domain\Client\Supplier\GetClientByIdSupplier;
use App\Domain\Client\Transformer\ClientTransformer;
use Psr\Log\LoggerInterface;
use Throwable;

class GetClientByIdScenario
{
    public function __construct(
        private readonly GetClientByIdSupplier $getClientByIdSupplier,
        private readonly ClientTransformer $clientTransformer,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(int $id): ?Client
    {
        $this->logger->info('GetClientByIdScenario started');

        try {
            $client = ($this->getClientByIdSupplier)($id);
        } catch (Throwable $e) {
            $this->logger->error(sprintf('GetClientByIdScenario error: %s', $e->getMessage()));
            return null;
        }

        $this->logger->info('GetClientByIdScenario success');

        return $this->clientTransformer->reverseTransform($client);
    }
}
