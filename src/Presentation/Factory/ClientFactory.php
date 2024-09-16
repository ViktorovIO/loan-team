<?php

declare(strict_types=1);

namespace App\Presentation\Factory;

use App\Domain\Client\Model\Client;
use App\Domain\Client\Model\ClientAddress;
use App\Presentation\Request\CreateClientRequest;

class ClientFactory
{
    public function make(CreateClientRequest $createClientRequest): Client
    {
        return new Client(
            null,
            $createClientRequest->getLastName(),
            $createClientRequest->getFirstName(),
            $createClientRequest->getAge(),
            $createClientRequest->getSsn(),
            $createClientRequest->getFicoScore(),
            $createClientRequest->getEmail(),
            $createClientRequest->getPhone(),
            $createClientRequest->getSalary(),
            new ClientAddress(
                null,
                $createClientRequest->getZip(),
                $createClientRequest->getState(),
                $createClientRequest->getCity()
            )
        );
    }
}
