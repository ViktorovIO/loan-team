<?php

declare(strict_types=1);

namespace App\Domain\Loan\Enum;

final class BaseRateEnum
{
    public const BASE_RATE = 7.9;
    public const CALIFORNIA_DIFF_RATE = 11.49;

    public static function getPercentRate(string $state): float
    {
        return $state === 'CA' ? self::BASE_RATE + self::CALIFORNIA_DIFF_RATE : self::BASE_RATE;
    }
}
