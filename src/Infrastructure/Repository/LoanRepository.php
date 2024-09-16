<?php

namespace App\Infrastructure\Repository;

use App\Domain\Loan\Contract\Infrastructure\LoanRepositoryInterface;
use App\Infrastructure\Entity\Loan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Loan>
 */
class LoanRepository extends ServiceEntityRepository implements LoanRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, Loan::class);
    }

    public function create(Loan $loan): int
    {
        $this->entityManager->persist($loan);
        $this->entityManager->flush();

        return $loan->getId();
    }
}
