<?php

namespace Claudio\LeaningAboutCleanArchitecture\Domain;

use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Cpf;
use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Email;

class Student
{
    public function __construct(
        public readonly string $name,
        public readonly Email $email,
        public readonly Cpf $cpf,
    ) {}
}
