<?php

declare(strict_types=1);

namespace App\Domain\Client\Supplier;

use App\Domain\Client\Contract\Infrastructure\ClientRepositoryInterface;
use App\Domain\Client\Exception\ClientNotFoundException;
use App\Infrastructure\Entity\Client as ClientEntity;

class GetClientByIdSupplier
{
    public function __construct(
        private readonly ClientRepositoryInterface $clientRepository,
    ) {}

    /**
     * @throws ClientNotFoundException
     */
    public function __invoke(int $id): ?ClientEntity
    {
        /** @var ClientEntity $clientEntity */
        $clientEntity = $this->clientRepository->find($id);
        if ($clientEntity === null) {
            throw new ClientNotFoundException();
        }

        return $clientEntity;
    }
}
