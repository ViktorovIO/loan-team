<?php

declare(strict_types=1);

namespace App\Domain\Loan\Enum;

final class BaseRateEnum
{
    public const BASE_RATE = 7.9;
    public const CALIFORNIA_DIFF_RATE = 11.49;

    public function getCalifornianRate(): float
    {
        return self::BASE_RATE + self::CALIFORNIA_DIFF_RATE;
    }
}
