<?php

namespace Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue;

use Claudio\LeaningAboutCleanArchitecture\Infra\Validator\ValidatorFields;

class Cpf
{
    public readonly string $cpf;

    public function __construct(string $cpf)
    {
        ValidatorFields::validateCpf($cpf);
        $this->cpf = $cpf;
    }
}
