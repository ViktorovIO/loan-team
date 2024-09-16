<?php

declare(strict_types=1);

namespace App\Domain\Loan\Validator;

use App\Domain\Client\Model\Client;

class LoanValidator implements ValidatorInterface
{
    public function __construct(
        private readonly iterable $validators,
    ) {}

    public function validate(Client $client): bool
    {
        foreach ($this->validators as $validator) {
            /** @var ValidatorInterface $validator */
            if ($validator->validate($client) === false) {
                return false;
            }
        }

        return true;
    }
}
