<?php

namespace App\Presentation\Controller;

use App\Application\Loan\LoanService;
use App\Presentation\Transformer\LoanTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class LoanController extends AbstractController
{
    public function __construct(
        private readonly LoanService $loanService,
        private readonly LoanTransformer $loanTransformer,
    ) {}

    #[Route('/api/loan/check/{clientId}', name: 'loan_check')]
    public function check(int $clientId): JsonResponse
    {
        return $this->json([
            'result' => $this->loanService->checkClient($clientId)
        ]);
    }

    #[Route('/api/loan/issuance/{clientId}', name: 'loan_issuance')]
    public function issuance(int $clientId): JsonResponse
    {
        $check = $this->loanService->checkClient($clientId);
        if ($check === false) {
            return $this->json(['Check Client Error']);
        }

        $id = $this->loanService->issuanceLoan($clientId);

        return $this->json([
            'loan' => $this->loanTransformer->toArray($this->loanService->getById($id))
        ]);
    }
}
