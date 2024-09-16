<?php

declare(strict_types=1);

namespace App\Domain\Notification\Message;

use App\Domain\Notification\Enum\NotificationTypeEnum;

class SendSmsMessage implements SendNotificationMessageInterface
{
    private string $type;
    private string $message;
    private string $recipient;

    public function __construct(string $message, string $recipient)
    {
        $this->type = NotificationTypeEnum::SMS->name;
        $this->message = $message;
        $this->recipient = $recipient;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }
}
