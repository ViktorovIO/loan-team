<?php

declare(strict_types=1);

namespace App\Application\Client;

use App\Domain\Client\Model\Client;
use App\Domain\Client\Model\UpdateClientRequest;
use App\Domain\Client\Scenario\CreateClientScenario;
use App\Domain\Client\Scenario\GetClientByIdScenario;
use App\Domain\Client\Scenario\UpdateClientScenario;
use App\Domain\Loan\Contract\Client\ClientServiceInterface as LoanClientServiceInterface;
use App\Domain\Notification\Contract\Client\ClientServiceInterface as NotificationClientServiceInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class ClientService implements LoanClientServiceInterface, NotificationClientServiceInterface
{
    public function __construct(
        private readonly ContainerInterface $container,
    ) {}

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getById(int $id): ?Client
    {
        $scenario = $this->container->get(GetClientByIdScenario::class);
        return $scenario($id);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create(Client $client): void
    {
        $scenario = $this->container->get(CreateClientScenario::class);
        $scenario($client);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update(UpdateClientRequest $updateClientRequest): void
    {
        $scenario = $this->container->get(UpdateClientScenario::class);
        $scenario($updateClientRequest);
    }
}
