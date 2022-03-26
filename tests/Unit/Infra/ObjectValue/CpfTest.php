<?php

namespace Unit\Infra\ObjectValue;

use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Cpf;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class CpfTest extends TestCase
{
    /** @test */
    public function shouldReturnExceptionIfCpfInvalidLength(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid cpf length');
        $cpfInvalid = '1231121221';
        new Cpf($cpfInvalid);
    }

    /** @test */
    public function shouldReturnExceptionIfCpfInvalidRules(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid cpf');
        $cpfInvalid = '641.850.434-21';
        new Cpf($cpfInvalid);
    }

    /** @test */
    public function shouldCreateCpfObject(): void
    {
        $cpfValid = '641.850.910-28';
        $cpf = new Cpf($cpfValid);
        self::assertEquals($cpf, $cpfValid);
    }
}