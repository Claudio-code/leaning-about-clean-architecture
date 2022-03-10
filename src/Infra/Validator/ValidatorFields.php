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
        $cpfToValidate = preg_replace( '/[^0-9]/is', '', $cpf );
        if (strlen($cpfToValidate) != 11) {
            throw new \InvalidArgumentException('Invalid cpf length');
        }

        if (preg_match('/(\d)\1{10}/', $cpfToValidate)) {
            throw new \InvalidArgumentException('Invalid cpf, why repeated values');
        }

        self::validateCpfPattern($cpfToValidate);
    }

    private static function validateCpfPattern(string $cpf): void
    {
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw new \InvalidArgumentException('Invalid cpf pattern');
            }
        }
    }
}
