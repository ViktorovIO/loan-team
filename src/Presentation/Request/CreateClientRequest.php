<?php

declare(strict_types=1);

namespace App\Presentation\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CreateClientRequest
{
    /** Фамилия */
    #[Assert\NotNull]
    private string $lastName;

    /** Имя */
    #[Assert\NotNull]
    private string $firstName;

    /** Возраст */
    #[Assert\NotNull]
    private int $age;

    /** SSN (социальный страховой номер) */
    #[Assert\NotNull]
    private string $ssn;

    /** FICO (кредитный рейтинг - число от 300 до 850) */
    #[Assert\NotNull]
    private int $ficoScore;

    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private string $email;

    /** Номер телефона */
    #[Assert\NotNull]
    private string $phone;

    /** Зарплата */
    #[Assert\NotNull]
    private float $salary;

    /** Почтовый индекс */
    #[Assert\NotNull]
    private string $zip;

    /** Штат */
    #[Assert\NotNull]
    private string $state;

    /** Город */
    #[Assert\NotNull]
    private string $city;

    public function __construct(
        string $lastName,
        string $firstName,
        int $age,
        string $ssn,
        int $ficoScore,
        string $email,
        string $phone,
        float $salary,
        string $zip,
        string $state,
        string $city,
    ) {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->age = $age;
        $this->ssn = $ssn;
        $this->ficoScore = $ficoScore;
        $this->email = $email;
        $this->phone = $phone;
        $this->salary = $salary;
        $this->zip = $zip;
        $this->state = $state;
        $this->city = $city;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getSsn(): string
    {
        return $this->ssn;
    }

    public function getFicoScore(): int
    {
        return $this->ficoScore;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
