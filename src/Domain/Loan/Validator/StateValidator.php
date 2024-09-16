<?php

declare(strict_types=1);

namespace App\Domain\Loan\Validator;

use App\Domain\Client\Model\Client;

class StateValidator implements ValidatorInterface
{
    private const VALID_STATES = ['CA', 'NY', 'NV'];

    public function validate(Client $client): bool
    {
        $clientState = $client->getAddress()->getState();

        $isValidState = in_array($clientState, self::VALID_STATES);
        if ($isValidState === false) {
            return false;
        }

        if ($clientState === 'NY') {
            return (bool)rand(0, 1);
        }

        return true;
    }
}
