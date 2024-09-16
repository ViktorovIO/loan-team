<?php

declare(strict_types=1);

namespace App\Domain\Loan\Scenario;

use App\Domain\Loan\Contract\Client\ClientServiceInterface;
use App\Domain\Loan\Validator\AgeValidator;
use App\Domain\Loan\Validator\FicoValidator;
use App\Domain\Loan\Validator\LoanValidator;
use App\Domain\Loan\Validator\SalaryValidator;
use App\Domain\Loan\Validator\StateValidator;
use Psr\Log\LoggerInterface;
use Throwable;

class CheckClientScenario
{
    public function __construct(
        private readonly ClientServiceInterface $clientService,
        private readonly AgeValidator $ageValidator,
        private readonly FicoValidator $ficoValidator,
        private readonly SalaryValidator $salaryValidator,
        private readonly StateValidator $stateValidator,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(int $clientId): bool
    {
        $this->logger->info('CheckClientScenario started');

        try {
            $client = $this->clientService->getById($clientId);

            $loanValidator = new LoanValidator([
                $this->ageValidator,
                $this->ficoValidator,
                $this->salaryValidator,
                $this->stateValidator,
            ]);

            $result = $loanValidator->validate($client);
        } catch (Throwable $e) {
            $this->logger->info(sprintf('CheckClientScenario error: %s', $e->getMessage()));
            return false;
        }

        $this->logger->info('CheckClientScenario finished');

        return $result;
    }
}
