<?php

declare(strict_types=1);

namespace App\Domain\Client\Updater;

use App\Domain\Client\Contract\Infrastructure\ClientRepositoryInterface;
use App\Domain\Client\Exception\UpdateException;
use App\Domain\Client\Model\UpdateClientRequest;
use App\Domain\Client\Supplier\GetClientByIdSupplier;
use Throwable;

class ClientUpdater
{
    public function __construct(
        private readonly GetClientByIdSupplier $getClientByIdSupplier,
        private readonly ClientRepositoryInterface $clientRepository,
    ) {}

    /**
     * @throws UpdateException
     */
    public function __invoke(UpdateClientRequest $request): void
    {
        try {
            $clientEntity = ($this->getClientByIdSupplier)($request->getClientId());
            foreach ($request->getChanges() as $key => $value) {
                $propertyMethod = sprintf('set%s', ucfirst($key));
                switch ($key) {
                    case 'zip':
                    case 'state':
                    case 'city':
                        $clientEntity->getAddress()->{$propertyMethod}($value);
                        break;
                    default:
                        $clientEntity->{$propertyMethod}($value);
                }
            }

            $this->clientRepository->update($clientEntity);
        } catch (Throwable $e) {
            throw new UpdateException($e->getMessage());
        }
    }
}
