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
            [100, StatusCodeClass::INFORMATIONAL],
            [128, StatusCodeClass::INFORMATIONAL],
            [199, StatusCodeClass::INFORMATIONAL],
            [200, StatusCodeClass::SUCCESSFUL],
            [256, StatusCodeClass::SUCCESSFUL],
            [299, StatusCodeClass::SUCCESSFUL],
            [300, StatusCodeClass::REDIRECTION],
            [312, StatusCodeClass::REDIRECTION],
            [399, StatusCodeClass::REDIRECTION],
            [400, StatusCodeClass::CLIENT_ERROR],
            [442, StatusCodeClass::CLIENT_ERROR],
            [499, StatusCodeClass::CLIENT_ERROR],
            [500, StatusCodeClass::SERVER_ERROR],
            [512, StatusCodeClass::SERVER_ERROR],
            [599, StatusCodeClass::SERVER_ERROR],
        ];
    }
}
