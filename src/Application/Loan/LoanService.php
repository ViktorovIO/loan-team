<?php

declare(strict_types=1);

namespace App\Application\Loan;

use App\Domain\Loan\Model\Loan;
use App\Domain\Loan\Scenario\CheckClientScenario;
use App\Domain\Loan\Scenario\CreateLoanScenario;
use App\Domain\Loan\Scenario\GetLoanByIdScenario;
use App\Domain\Notification\Contract\Loan\LoanServiceInterface as NotificationLoanServiceInterface;
use Psr\Container\ContainerInterface;

class LoanService implements NotificationLoanServiceInterface
{
    public function __construct(
        private readonly ContainerInterface $container,
    ) {}

    public function checkClient(int $clientId): bool
    {
        $scenario = $this->container->get(CheckClientScenario::class);
        return ($scenario)($clientId);
    }

    public function issuanceLoan(int $clientId): int
    {
        $scenario = $this->container->get(CreateLoanScenario::class);
        return ($scenario)($clientId);
    }

    public function getById(int $id): ?Loan
    {
        $scenario = $this->container->get(GetLoanByIdScenario::class);
        return ($scenario)($id);
    }
}
