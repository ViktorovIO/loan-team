<?php

declare(strict_types=1);

namespace App\Domain\Notification\Handler;

use App\Domain\Notification\Enum\NotificationTypeEnum;
use App\Domain\Notification\Exception\SendNotificationException;
use App\Domain\Notification\Message\SendNotificationMessageInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class SendNotificationHandler
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws SendNotificationException
     */
    public function __invoke(SendNotificationMessageInterface $message): void
    {
        if ($message->getType() === NotificationTypeEnum::Email->name) {
            $this->sendEmail($message);
        } else {
            // $this->sendSms($message);
        }
    }

    /**
     * @throws SendNotificationException
     */
    private function sendEmail(SendNotificationMessageInterface $message): void
    {
        $email = (new Email())
            ->from('noreply@loan-team.com')
            ->to($message->getRecipient())
            ->subject('Loan Created')
            ->text($message->getMessage());

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $exception) {
            throw new SendNotificationException(sprintf('Mail is not sended. Reason: %s', $exception->getMessage()));
        }
    }
}