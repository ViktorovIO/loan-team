<?php

declare(strict_types=1);

namespace App\Domain\Loan\Validator;

use App\Domain\Client\Model\Client;

class AgeValidator implements ValidatorInterface
{
    public function validate(Client $client): bool
    {
        return $client->getAge() > 18 && $client->getAge() < 60;
    }
}
