<?php

namespace Unit\Infra\ObjectValue;

use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\Phone;
use Claudio\LeaningAboutCleanArchitecture\Infra\ObjectValue\PhoneCollection;
use PHPUnit\Framework\TestCase;

class PhoneCollectionTest extends TestCase
{
    /** @test */
    public function shouldAddNewPhoneButNotAddSamePhoneTwoMany(): void
    {
        $phoneCollection = PhoneCollection::makeEmpty();
        $phone = new Phone('33', '998329212');
        $phoneCollection->add(new \DateTime());
        $phoneCollection->set($phone, $phone);
        $phoneCollection->add($phone);
        self::assertCount(1, $phoneCollection);
        self::assertInstanceOf(Phone::class, $phoneCollection->first());
    }
}
