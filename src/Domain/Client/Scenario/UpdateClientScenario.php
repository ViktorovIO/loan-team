<?php

declare(strict_types=1);

namespace App\Domain\Client\Scenario;

use App\Domain\Client\Exception\ValidationException;
use App\Domain\Client\Model\Client;
use App\Domain\Client\Model\UpdateClientRequest;
use App\Domain\Client\Supplier\GetClientByIdSupplier;
use App\Domain\Client\Transformer\ClientTransformer;
use App\Domain\Client\Updater\ClientUpdater;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use Throwable;

class UpdateClientScenario
{
    public function __construct(
        private readonly ClientUpdater $clientUpdater,
        private readonly GetClientByIdSupplier $getClientByIdSupplier,
        private readonly ClientTransformer $clientTransformer,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(UpdateClientRequest $updateClientRequest)
    {
        $this->logger->info('Update Client started');

        try {
            $clientEntity = ($this->getClientByIdSupplier)($updateClientRequest->getClientId());
            $client = $this->clientTransformer->reverseTransform($clientEntity);

            if ($this->validateRequest($client, $updateClientRequest) === false) {
                throw new ValidationException('No changes');
            }

            ($this->clientUpdater)($updateClientRequest);
        } catch (Throwable $e) {
            $this->logger->error(sprintf('Update Client failed: %s', $e->getMessage()));
        }

        $this->logger->info('Update Client finished');
    }

    private function validateRequest(Client $client, UpdateClientRequest $updateClientRequest): bool
    {
        if (count($updateClientRequest->getChanges()) === 0) {
            return false;
        }

        $clientReflection = new ReflectionClass($client);
        $addressReflection = new ReflectionClass($client->getAddress());

        foreach ($updateClientRequest->getChanges() as $key => $item) {
            switch ($key) {
                case 'zip':
                case 'state':
                case 'city':
                    $clientProperty = $addressReflection->getProperty($key);
                    $clientProperty->setAccessible(true);
                    $oldValue = $clientProperty->getValue($client->getAddress());
                    break;
                default:
                    $clientProperty = $clientReflection->getProperty($key);
                    $clientProperty->setAccessible(true);
                    $oldValue = $clientProperty->getValue($client);
            }

            if ($oldValue === $item) {
                $updateClientRequest->removeChangeItem($key);
            }
        }

        return count($updateClientRequest->getChanges()) > 0;
    }
}
