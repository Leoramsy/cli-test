<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Classes\StringTransformation;

class StringTest extends TestCase
{
    /** @var StringTransformation $string */

    protected StringTransformation $string;

    public function setUp() : void
    {
        Parent::setUp();
        $this->string = new StringTransformation("hello world");
    }

    public function testUpperCase(): void
    {
        $this->assertSame($this->string->getUpperCase(), 'HELLO WORLD');
    }

    public function testAlternateCase(): void
    {
        $this->assertSame($this->string->getAlternateCase(), 'hElLo wOrLd');
    }

    public function testCsvWasCreated(): void
    {
        $file_path = base_path() . '/' . $this->string->getString() . '.csv';
        $this->assertTrue($this->string->outputCsv(), 'CSV was not created');
        $this->assertFileExists($file_path, 'File ' . $this->string->getString() . '.csv does not exist');
    }


}
