<?php

declare(strict_types=1);

namespace App\Domain\Client\Contract\Infrastructure;


use App\Infrastructure\Entity\Client;

interface ClientRepositoryInterface
{
    public function create(Client $client): void;
    public function update(Client $client): void;
}
