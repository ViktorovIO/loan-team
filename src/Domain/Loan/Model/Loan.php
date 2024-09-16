<?php

declare(strict_types=1);

namespace App\Domain\Loan\Model;

class Loan
{
    public function __construct(
        private readonly ?int $id,
        private readonly string $title,
        private readonly int $term,
        private float $percentRate,
        private float $sum,
        private int $clientId,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function getPercentRate(): float
    {
        return $this->percentRate;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function setPercentRate(float $percentRate): void
    {
        $this->percentRate = $percentRate;
    }

    public function setSum(float $sum): void
    {
        $this->sum = $sum;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }
}
