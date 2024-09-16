<?php

declare(strict_types=1);

namespace App\Domain\Notification\Enum;

enum NotificationTypeEnum
{
    case Email;
    case SMS;
}