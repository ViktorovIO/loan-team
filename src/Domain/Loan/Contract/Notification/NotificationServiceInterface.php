<?php

declare(strict_types=1);

namespace App\Domain\Loan\Contract\Notification;

interface NotificationServiceInterface
{
    public function notify(int $loanId, int $clientId, string $type): void;
}
