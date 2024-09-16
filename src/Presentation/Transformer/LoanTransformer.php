<?php

declare(strict_types=1);

namespace App\Presentation\Transformer;

use App\Domain\Loan\Model\Loan;
use JetBrains\PhpStorm\ArrayShape;

class LoanTransformer
{
    #[ArrayShape([
        'id' => "int|null",
        'title' => "string",
        'term' => "int",
        'percentRate' => "float",
        'sum' => "float",
        'clientId' => "int"
    ])]
    public function toArray(Loan $loan): array
    {
        return [
            'id' => $loan->getId(),
            'title' => $loan->getTitle(),
            'term' => $loan->getTerm(),
            'percentRate' => $loan->getPercentRate(),
            'sum' => $loan->getSum(),
            'clientId' => $loan->getClientId(),
        ];
    }
}
