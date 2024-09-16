<?php

declare(strict_types=1);

namespace App\Domain\Loan\Contract\Client;

use App\Domain\Client\Model\Client;

interface ClientServiceInterface
{
    public function getById(int $id): ?Client;
}
