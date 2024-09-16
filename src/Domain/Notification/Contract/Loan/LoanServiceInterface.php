<?php

declare(strict_types=1);

namespace App\Domain\Notification\Contract\Loan;

use App\Domain\Loan\Model\Loan;

interface LoanServiceInterface
{
    public function getById(int $id): ?Loan;
}
