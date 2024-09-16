<?php

declare(strict_types=1);

namespace App\Domain\Loan\Transformer;

use App\Domain\Loan\Model\Loan;
use App\Infrastructure\Entity\Loan as LoanEntity;

class LoanTransformer
{
    public function transform(Loan $loan, int $clientId): LoanEntity
    {
        $loanEntity = new LoanEntity();
        $loanEntity->setId($loan->getId());
        $loanEntity->setTitle($loan->getTitle());
        $loanEntity->setPercentRate($loan->getPercentRate());
        $loanEntity->setSum($loan->getSum());
        $loanEntity->setTerm($loan->getTerm());
        $loanEntity->setClientId($clientId);

        return $loanEntity;
    }

    public function reverseTransform(LoanEntity $loanEntity): Loan
    {
        return new Loan(
            $loanEntity->getId(),
            $loanEntity->getTitle(),
            $loanEntity->getTerm(),
            $loanEntity->getPercentRate(),
            $loanEntity->getSum(),
            $loanEntity->getClientId()
        );
    }
}
