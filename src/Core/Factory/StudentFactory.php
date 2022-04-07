<?php

namespace Claudio\LeaningAboutCleanArchitecture\Core\Factory;

use Claudio\LeaningAboutCleanArchitecture\Domain\Student;
use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Cpf;
use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Email;
use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Phone;

class StudentFactory
{
    private readonly Student $student;

    public function student(): Student
    {
        return $this->student;
    }

    public function make(string $name, string $email, string $cpf): self
    {
        $emailObject = new Email($email);
        $cpfObject = new Cpf($cpf);
        $this->student = new Student($name, $emailObject, $cpfObject);
        return $this;
    }

    public function addPhone(string $ddd, string $number): self
    {
        $phone = new Phone($ddd, $number);
        $this->student->phoneCollection->add($phone);
        return $this;
    }
}
