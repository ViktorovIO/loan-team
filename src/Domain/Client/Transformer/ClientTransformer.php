<?php

declare(strict_types=1);

namespace App\Domain\Client\Transformer;

use App\Domain\Client\Model\Client;
use App\Domain\Client\Model\ClientAddress;
use App\Infrastructure\Entity\Client as ClientEntity;
use App\Infrastructure\Entity\ClientAddress as ClientAddressEntity;

class ClientTransformer
{
    public function transform(Client $client): ClientEntity
    {
        $clientEntity = new ClientEntity();
        $clientEntity->setId($client->getId());
        $clientEntity->setLastName($client->getLastName());
        $clientEntity->setFirstName($client->getFirstName());
        $clientEntity->setAge($client->getAge());
        $clientEntity->setSsn($client->getSsn());
        $clientEntity->setFico($client->getFico());
        $clientEntity->setEmail($client->getEmail());
        $clientEntity->setPhone($client->getPhone());
        $clientEntity->setSalary($client->getSalary());

        $clientAddressEntity = new ClientAddressEntity();
        $clientAddressEntity->setId($client->getAddress()->getId());
        $clientAddressEntity->setZip($client->getAddress()->getZip());
        $clientAddressEntity->setState($client->getAddress()->getState());
        $clientAddressEntity->setCity($client->getAddress()->getCity());

        $clientEntity->setAddress($clientAddressEntity);

        return $clientEntity;
    }

    public function reverseTransform(ClientEntity $clientEntity): Client
    {
        return new Client(
            $clientEntity->getId(),
            $clientEntity->getLastName(),
            $clientEntity->getFirstName(),
            $clientEntity->getAge(),
            $clientEntity->getSsn(),
            $clientEntity->getFico(),
            $clientEntity->getEmail(),
            $clientEntity->getPhone(),
            $clientEntity->getSalary(),
            new ClientAddress(
                $clientEntity->getAddress()->getId(),
                $clientEntity->getAddress()->getZip(),
                $clientEntity->getAddress()->getState(),
                $clientEntity->getAddress()->getCity()
            )
        );
    }
}
