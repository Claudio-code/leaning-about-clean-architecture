<?php

namespace Claudio\LeaningAboutCleanArchitecture\Domain;

use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Cpf;
use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Email;
use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\PhoneCollection;

class Student
{
    public readonly PhoneCollection $phoneCollection;

    public function __construct(
        public readonly string $name,
        public readonly Email $email,
        public readonly Cpf $cpf,
    ) {
        $this->phoneCollection = PhoneCollection::makeEmpty();
    }

    public function isEqualAnotherStudent(Student $anotherStudent): bool
    {
        return $anotherStudent->cpf === $this->cpf;
    }
}
