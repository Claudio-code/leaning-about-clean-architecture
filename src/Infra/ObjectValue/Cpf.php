<?php

namespace Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue;

use Claudio\LeaningAboutCleanArchitecture\Infra\Validator\ValidatorFields;

class Cpf
{
    private readonly string $cpf;

    public function __construct(string $cpf)
    {
        ValidatorFields::validateCpf($cpf);
        $this->cpf = $cpf;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}
