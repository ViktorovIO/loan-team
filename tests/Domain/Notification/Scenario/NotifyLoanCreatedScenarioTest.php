<?php

declare(strict_types=1);

namespace App\Tests\Domain\Notification\Scenario;

use App\Domain\Client\Model\Client;
use App\Domain\Loan\Model\Loan;
use App\Domain\Notification\Contract\Client\ClientServiceInterface;
use App\Domain\Notification\Contract\Loan\LoanServiceInterface;
use App\Domain\Notification\Enum\NotificationTypeEnum;
use App\Domain\Notification\Message\SendEmailMessage;
use App\Domain\Notification\Scenario\NotifyLoanCreatedScenario;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class NotifyLoanCreatedScenarioTest extends TestCase
{
    private NotifyLoanCreatedScenario $scenario;

    /** @var ClientServiceInterface|MockObject */
    private ClientServiceInterface $clientService;

    /** @var LoanServiceInterface|MockObject  */
    private LoanServiceInterface $loanService;

    /** @var MessageBusInterface|MockObject  */
    private MessageBusInterface $eventBus;

    /** @var LoggerInterface|MockObject  */
    private LoggerInterface $logger;

    public function setUp(): void
    {
        $this->clientService = $this->createMock(ClientServiceInterface::class);
        $this->loanService = $this->createMock(LoanServiceInterface::class);
        $this->eventBus = $this->createMock(MessageBusInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);

        $this->scenario = new NotifyLoanCreatedScenario(
            $this->clientService,
            $this->loanService,
            $this->eventBus,
            $this->logger
        );
    }

    public function testSendEmailMessage(): void
    {
        $loanId = 1;
        $clientId = 1;
        $type = NotificationTypeEnum::Email->name;

        $client = $this->createMock(Client::class);
        $client
            ->expects($this->once())
            ->method('getEmail')
            ->willReturn('example@domain.com');

        $loan = $this->createMock(Loan::class);
        $loan
            ->expects($this->once())
            ->method('getSum')
            ->willReturn(1000.00);
        $loan
            ->expects($this->once())
            ->method('getTerm')
            ->willReturn(120);
        $loan
            ->expects($this->once())
            ->method('getPercentRate')
            ->willReturn(7.9);

        $this->logger
            ->expects($this->exactly(2))
            ->method('info');

        $this->clientService
            ->expects($this->once())
            ->method('getById')
            ->with($clientId)
            ->willReturn($client);

        $this->loanService
            ->expects($this->once())
            ->method('getById')
            ->with($loanId)
            ->willReturn($loan);

        $envelope = new Envelope($this->getEmailMessage());
        $this->eventBus
            ->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo($this->getEmailMessage()))
            ->willReturn($envelope);

        ($this->scenario)($loanId, $clientId, $type);
    }

    private function getEmailMessage(): SendEmailMessage
    {
        return new SendEmailMessage("Loan 1 created!\nSum: 1000;\nTerm 120;\nPercentRate: 7.9.", "example@domain.com");
    }
}
