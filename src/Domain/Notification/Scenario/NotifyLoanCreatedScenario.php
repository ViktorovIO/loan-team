<?php

declare(strict_types=1);

namespace App\Domain\Notification\Scenario;

use App\Domain\Notification\Contract\Client\ClientServiceInterface;
use App\Domain\Notification\Contract\Loan\LoanServiceInterface;
use App\Domain\Notification\Enum\NotificationTypeEnum;
use App\Domain\Notification\Exception\NotificationTypeNotFoundException;
use App\Domain\Notification\Message\SendEmailMessage;
use App\Domain\Notification\Message\SendSmsMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

class NotifyLoanCreatedScenario
{
    public function __construct(
        private readonly ClientServiceInterface $clientService,
        private readonly LoanServiceInterface $loanService,
        private readonly MessageBusInterface $eventBus,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(int $loanId, int $clientId, string $type): void
    {
        $this->logger->info('NotifyLoanCreatedScenario started');

        try {
            $client = $this->clientService->getById($clientId);
            $loan = $this->loanService->getById($loanId);
            $message = sprintf(
                "Loan %d created!\nSum: %s;\nTerm %d;\nPercentRate: %s.",
                $loanId,
                $loan->getSum(),
                $loan->getTerm(),
                $loan->getPercentRate()
            );

            $message = match ($type) {
                NotificationTypeEnum::Email->name => new SendEmailMessage($message, $client->getEmail()),
                NotificationTypeEnum::SMS->name => new SendSmsMessage($message, $client->getPhone()),
                default => throw new NotificationTypeNotFoundException(sprintf('Type %s not found', $type)),
            };

            $this->eventBus->dispatch($message);
        } catch (Throwable $e) {
            $this->logger->error(sprintf('NotifyLoanCreatedScenario error: %s', $e->getMessage()));
            return;
        }

        $this->logger->info('NotifyLoanCreatedScenario finished');
    }
}
