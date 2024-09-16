<?php

declare(strict_types=1);

namespace App\Domain\Client\Model;

class UpdateClientRequest
{
    private int $clientId;
    private array $changes;

    public function __construct(int $clientId)
    {
        $this->clientId = $clientId;
        $this->changes = [];
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getChanges(): array
    {
        return $this->changes;
    }

    public function addChangeItem(string $key, mixed $value): void
    {
        $this->changes[$key] = $value;
    }

    public function removeChangeItem(string $key): void
    {
        unset($this->changes[$key]);
    }
}
