<?php

namespace Claudio\LeaningAboutCleanArchitecture\Domain;

class Indication
{
    public function __construct(
        public readonly Student $pointer,
        public readonly Student $indicated,
    ) {
        $this->validateIfPointerAndIndicatedIsSamePeople();
    }

    private function validateIfPointerAndIndicatedIsSamePeople(): void
    {
        if (!$this->pointer->isEqualAnotherStudent($this->indicated)) {
            return;
        }
        throw new \InvalidArgumentException("The pointer student and indicated is same people");
    }
}
