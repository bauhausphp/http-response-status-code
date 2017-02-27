<?php

namespace Bauhaus\Http\Response;

use PHPUnit\Framework\TestCase;

class StatusCodeTest extends TestCase
{
    /**
     * @test
     * @dataProvider codesAndClasses
     */
    public function classifyItselfAccordingToItsCode($code, $expectedClass)
    {
        $statusCode = new StatusCode($code);

        $class = $statusCode->class();

        $this->assertEquals($expectedClass, $class);
    }

    public function codesAndClasses()
    {
        return [
            [100, 'Informational'],
            [128, 'Informational'],
            [199, 'Informational'],
            [200, 'Successful'],
            [256, 'Successful'],
            [299, 'Successful'],
            [300, 'Redirection'],
            [312, 'Redirection'],
            [399, 'Redirection'],
            [400, 'Client Error'],
            [442, 'Client Error'],
            [499, 'Client Error'],
            [500, 'Server Error'],
            [512, 'Server Error'],
            [599, 'Server Error'],
        ];
    }
}
