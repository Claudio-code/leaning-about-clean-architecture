<?php

namespace Claudio\LeaningAboutCleanArchitecture\Domain\ObjectValue;

use Doctrine\Common\Collections\ArrayCollection;

class PhoneCollection extends ArrayCollection
{
    public static function makeEmpty(): self
    {
        return new self();
    }

    public function add(mixed $element): bool
    {
        $this->set($element, $element);
        return true;
    }

    public function set(mixed $key, mixed $value): void
    {
        if (!($key instanceof Phone) || !($value instanceof Phone)) {
            return;
        }
        parent::set($key?->toString(), $value);
    }
}
