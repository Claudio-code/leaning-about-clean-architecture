<?php

namespace Infra\ObjectValue;

use Claudio\LeaningAboutCleanArchitecture\Domain\ObjectValue\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /** @test */
    public function shouldCreateEmailObject(): void
    {
        $emailValid = 'nome@gmail.com';
        $email = new Email($emailValid);

        self::assertEquals($emailValid, $email);
    }

    /** @test */
    public function shouldReturnExceptionIfInvalidEmail(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid e-mail address');
        $emailInvalid = '2eofepqo@gmaidwqdq';
        new Email($emailInvalid);
    }
}