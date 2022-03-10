<?php

namespace Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue;

use Claudio\LeaningAboutCleanArchitecture\Infra\Validator\ValidatorFields;

class Email
{
    public readonly string $email;

    public function __construct(string $email)
    {
        ValidatorFields::validateEmail($email);
        $this->email = $email;
    }
}
