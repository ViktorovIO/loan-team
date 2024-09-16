<?php

declare(strict_types=1);

namespace App\Domain\Notification\Message;

interface SendNotificationMessageInterface
{
    public function getType(): string;
    public function getMessage(): string;
    public function getRecipient(): string;
}