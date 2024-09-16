<?php

declare(strict_types=1);

namespace App\Domain\Client\Model;

class Client
{
    public function __construct(
        private readonly ?int $id,
        private readonly string $lastName,
        private readonly string $firstName,
        private readonly int $age,
        private readonly string $ssn,
        private readonly int $fico,
        private readonly string $email,
        private readonly string $phone,
        private readonly float $salary,
        private readonly ClientAddress $address,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getSsn(): string
    {
        return $this->ssn;
    }

    public function getFico(): int
    {
        return $this->fico;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): ClientAddress
    {
        return $this->address;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }
}
