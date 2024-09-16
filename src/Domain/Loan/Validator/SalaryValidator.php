<?php

declare(strict_types=1);

namespace App\Domain\Loan\Validator;

use App\Domain\Client\Model\Client;

class SalaryValidator implements ValidatorInterface
{

    public function validate(Client $client): bool
    {
        return $client->getSalary() >= 1000.00;
    }
}
