<?php

declare(strict_types=1);

namespace App\Domain\Loan\Model;

class Loan
{
    public function __construct(
        private readonly ?int $id,
        private readonly string $title,
        private readonly string $term,
        private float $percentRate,
        private float $sum,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTerm(): string
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
}
