<?php

declare(strict_types=1);

namespace App\Domain\Loan\Scenario;

use App\Domain\Loan\Model\Loan;
use App\Domain\Loan\Supplier\GetLoanByIdSupplier;
use App\Domain\Loan\Transformer\LoanTransformer;
use Psr\Log\LoggerInterface;
use Throwable;

class GetLoanByIdScenario
{
    public function __construct(
        private readonly GetLoanByIdSupplier $getLoanByIdSupplier,
        private readonly LoanTransformer $loanTransformer,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(int $id): ?Loan
    {
        $this->logger->info('GetLoanByIdScenario started');

        try {
            $loan = ($this->getLoanByIdSupplier)($id);
        } catch (Throwable $e) {
            $this->logger->error(sprintf('GetLoanByIdScenario error: %s', $e->getMessage()));
            return null;
        }

        $this->logger->info('GetLoanByIdScenario success');

        return $this->loanTransformer->reverseTransform($loan);
    }
}
