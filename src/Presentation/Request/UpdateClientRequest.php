<?php

declare(strict_types=1);

namespace App\Presentation\Request;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateClientRequest
{
    /** Фамилия */
    private ?string $lastName;

    /** Имя */
    private ?string $firstName;

    /** Возраст */
    private ?int $age;

    /** SSN (социальный страховой номер) */
    private ?string $ssn;

    /** FICO (кредитный рейтинг - число от 300 до 850) */
    private ?int $ficoScore;

    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private ?string $email;

    /** Номер телефона */
    private ?string $phone;

    /** Зарплата */
    private ?float $salary;

    /** Почтовый индекс */
    private ?string $zip;

    /** Штат */
    private ?string $state;

    /** Город */
    private ?string $city;

    public function __construct(
        ?string $lastName,
        ?string $firstName,
        ?int $age,
        ?string $ssn,
        ?int $ficoScore,
        ?string $email,
        ?string $phone,
        ?float $salary,
        ?string $zip,
        ?string $state,
        ?string $city,
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function getSsn(): ?string
    {
        return $this->ssn;
    }

    public function getFicoScore(): ?int
    {
        return $this->ficoScore;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
}
