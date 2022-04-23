<?php

namespace Claudio\LeaningAboutCleanArchitecture\Domain\ObjectValue;

class Phone
{
    private readonly string $ddd;
    private readonly string $number;

    public function __construct(string $ddd, string $number)
    {
        $this->ddd = $this->setDdd($ddd);
        $this->number = $this->setNumber($number);
    }

    private function setDdd(string $ddd): string
    {
        return match ((bool) preg_match('/^[0-9]{2}$/', $ddd)) {
            true => $ddd,
            default => throw new \InvalidArgumentException('Invalid ddd'),
        };
    }

    private function setNumber(string $number): string
    {
        return match ((bool) preg_match('/^[0-9]{9}$/', $number)) {
            true => $number,
            default => throw new \InvalidArgumentException('Invalid number'),
        };
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->ddd . $this->number;
    }
}
