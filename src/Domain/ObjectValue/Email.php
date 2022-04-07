<?php

namespace Claudio\LeaningAboutCleanArchitecture\Domain\ObjectValue;

use Claudio\LeaningAboutCleanArchitecture\Infra\Validator\ValidatorFields;

class Email implements \Stringable
{
    private readonly string $email;

    public function __construct(string $email)
    {
        ValidatorFields::validateEmail($email);
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
