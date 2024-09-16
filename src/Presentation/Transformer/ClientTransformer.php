<?php

declare(strict_types=1);

namespace App\Presentation\Transformer;

use App\Domain\Client\Model\Client;
use JetBrains\PhpStorm\ArrayShape;

class ClientTransformer
{
    #[ArrayShape([
        'id' => "int|null",
        'lastName' => "string",
        'firstName' => "string",
        'age' => "int",
        'ssn' => "string",
        'fico' => "int",
        'email' => "string",
        'phone' => "string",
        'address' => "array"
    ])]
    public function toArray(Client $client): array
    {
        return [
            'id' => $client->getId(),
            'lastName' => $client->getLastName(),
            'firstName' => $client->getFirstName(),
            'age' => $client->getAge(),
            'ssn' => $client->getSsn(),
            'fico' => $client->getFico(),
            'email' => $client->getEmail(),
            'phone' => $client->getPhone(),
            'address' => [
                'zip' => $client->getAddress()->getZip(),
                'state' => $client->getAddress()->getState(),
                'city' => $client->getAddress()->getCity(),
            ],
        ];
    }
}
