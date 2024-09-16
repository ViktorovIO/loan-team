<?php

declare(strict_types=1);

namespace App\Presentation\Factory;

use App\Domain\Client\Model\UpdateClientRequest;
use App\Presentation\Request\UpdateClientRequest as ViewUpdateClientRequest;

class ClientUpdateRequestFactory
{
    public function make(int $clientId, ViewUpdateClientRequest $viewUpdateClientRequest): UpdateClientRequest
    {
        $updateClientRequest = new UpdateClientRequest($clientId);

        if ($viewUpdateClientRequest->getLastName() !== null) {
            $updateClientRequest->addChangeItem('lastName', $viewUpdateClientRequest->getLastName());
        }

        if ($viewUpdateClientRequest->getFirstName() !== null) {
            $updateClientRequest->addChangeItem('firstName', $viewUpdateClientRequest->getFirstName());
        }

        if ($viewUpdateClientRequest->getAge() !== null) {
            $updateClientRequest->addChangeItem('age', $viewUpdateClientRequest->getAge());
        }

        if ($viewUpdateClientRequest->getSsn() !== null) {
            $updateClientRequest->addChangeItem('ssn', $viewUpdateClientRequest->getSsn());
        }

        if ($viewUpdateClientRequest->getFicoScore() !== null) {
            $updateClientRequest->addChangeItem('fico', $viewUpdateClientRequest->getFicoScore());
        }

        if ($viewUpdateClientRequest->getEmail() !== null) {
            $updateClientRequest->addChangeItem('email', $viewUpdateClientRequest->getEmail());
        }

        if ($viewUpdateClientRequest->getPhone() !== null) {
            $updateClientRequest->addChangeItem('phone', $viewUpdateClientRequest->getPhone());
        }

        if ($viewUpdateClientRequest->getSalary() !== null) {
            $updateClientRequest->addChangeItem('salary', $viewUpdateClientRequest->getSalary());
        }

        if ($viewUpdateClientRequest->getZip() !== null) {
            $updateClientRequest->addChangeItem('zip', $viewUpdateClientRequest->getZip());
        }

        if ($viewUpdateClientRequest->getState() !== null) {
            $updateClientRequest->addChangeItem('state', $viewUpdateClientRequest->getState());
        }

        if ($viewUpdateClientRequest->getCity() !== null) {
            $updateClientRequest->addChangeItem('city', $viewUpdateClientRequest->getCity());
        }

        return $updateClientRequest;
    }
}
