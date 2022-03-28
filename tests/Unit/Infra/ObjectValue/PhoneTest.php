<?php

namespace Unit\Infra\ObjectValue;

use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    /** @test */
    public function shouldThrowExceptionIfInvalidDDD(): void
    {
        self::expectException(\InvalidArgumentException::class);
        new Phone('212','2121212');
    }

    /** @test */
    public function shouldThrowExceptionIfInvalidPhoneNumber(): void
    {
        self::expectException(\InvalidArgumentException::class);
        new Phone('21','2121212');
    }
}
