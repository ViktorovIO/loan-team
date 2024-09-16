<?php

declare(strict_types=1);

namespace App\Application\Notification;

use App\Domain\Loan\Contract\Notification\NotificationServiceInterface as LoanNotificationServiceInterface;
use App\Domain\Notification\Scenario\NotifyLoanCreatedScenario;
use Psr\Container\ContainerInterface;

class NotificationService implements LoanNotificationServiceInterface
{
    public function __construct(
        private readonly ContainerInterface $container,
    ) {}

    public function notify(int $loanId, int $clientId, string $type): void
    {
        $scenario = $this->container->get(NotifyLoanCreatedScenario::class);
        ($scenario)($loanId, $clientId, $type);
    }
}
