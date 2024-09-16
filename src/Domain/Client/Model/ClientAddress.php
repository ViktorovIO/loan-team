<?php

declare(strict_types=1);

namespace App\Domain\Client\Model;

class ClientAddress
{
    public function __construct(
        private ?int $id,
        private readonly string $zip,
        private readonly string $state,
        private readonly string $city,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
