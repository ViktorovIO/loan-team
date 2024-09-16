<?php

declare(strict_types=1);

namespace App\Domain\Loan\Scenario;

use App\Domain\Loan\Contract\Client\ClientServiceInterface;
use App\Domain\Loan\Contract\Infrastructure\LoanRepositoryInterface;
use App\Domain\Loan\Enum\BaseRateEnum;
use App\Infrastructure\Entity\Loan;
use Psr\Log\LoggerInterface;
use Throwable;

class CreateLoanScenario
{
    public function __construct(
        private readonly LoanRepositoryInterface $loanRepository,
        private readonly ClientServiceInterface $clientService,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(int $clientId): ?int
    {
        $this->logger->info('CreateLoanScenario started');

        try {
            $client = $this->clientService->getById($clientId);

            $loan = new Loan();
            $loan->setTitle('rand');
            $loan->setTerm(120);
            $loan->setPercentRate(BaseRateEnum::getPercentRate($client->getAddress()->getState()));
            $loan->setSum(10000.00);
            $loan->setClientId($clientId);

            $loanId = $this->loanRepository->create($loan);
        } catch (Throwable $e) {
            $this->logger->info(sprintf('CreateLoanScenario error: %s', $e->getMessage()));
            return null;
        }

        $this->logger->info('CreateLoanScenario success');

        return $loanId;
    }
}
