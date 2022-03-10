<?php

namespace Claudio\LeaningAboutCleanArchitecture\Infra\Validator;

class ValidatorFields
{
    public static function validateEmail(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            return;
        }
        throw new \InvalidArgumentException('Invalid e-mail address');
    }

    public static function validateCpf(string $cpf): void
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        if (strlen($cpf) != 11) {
            throw new \InvalidArgumentException('Invalid cpf');
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw new \InvalidArgumentException('Invalid cpf');
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw new \InvalidArgumentException('Invalid cpf');
            }
        }
    }
}
