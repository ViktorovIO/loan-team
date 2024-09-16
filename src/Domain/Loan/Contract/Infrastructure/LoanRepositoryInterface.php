<?php

declare(strict_types=1);

namespace App\Domain\Loan\Contract\Infrastructure;

use App\Infrastructure\Entity\Loan;

interface LoanRepositoryInterface
{
    public function create(Loan $loan): int;
}
