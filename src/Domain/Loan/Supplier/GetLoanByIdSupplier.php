<?php

declare(strict_types=1);

namespace App\Domain\Loan\Supplier;

use App\Domain\Loan\Exception\LoanNotFoundException;
use App\Domain\Loan\Contract\Infrastructure\LoanRepositoryInterface;
use App\Infrastructure\Entity\Loan as LoanEntity;

class GetLoanByIdSupplier
{
    public function __construct(
        private readonly LoanRepositoryInterface $loanRepository,
    ) {}

    /**
     * @throws LoanNotFoundException
     */
    public function __invoke(int $id): ?LoanEntity
    {
        /** @var LoanEntity $loanEntity */
        $loanEntity = $this->loanRepository->find($id);
        if ($loanEntity === null) {
            throw new LoanNotFoundException();
        }

        return $loanEntity;
    }
}
