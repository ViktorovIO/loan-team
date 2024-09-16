<?php

declare(strict_types=1);

namespace App\Domain\Loan\Validator;

use App\Domain\Client\Model\Client;

interface ValidatorInterface
{
    public function validate(Client $client): bool;
}
