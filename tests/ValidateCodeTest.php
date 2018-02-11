<?php

namespace Bauhaus\Http\Response;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ValidateCodeTest extends TestCase
{
    /**
     * @test
     */
    public function storeCodeAsInteger()
    {
        $statusCode = Status::create('201');

        $this->assertSame(201, $statusCode->code());
    }

    /**
     * @test
     * @dataProvider invalidCodes
     */
    public function throwInvalidArgumentExceptionGivenCodeIsOutOfValidRange(int $invalidCode)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The status code '$invalidCode' is invalid");

        Status::create($invalidCode);
    }

    public function invalidCodes()
    {
        return [
            'Invalid Code -10' => [-10],
            'Invalid Code 8' => [8],
            'Invalid Code 99' => [99],
            'Invalid Code 600' => [600],
        ];
    }
}
