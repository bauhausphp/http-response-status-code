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
            [100, StatusCode::CLASS_INFORMATIONAL],
            [128, StatusCode::CLASS_INFORMATIONAL],
            [199, StatusCode::CLASS_INFORMATIONAL],
            [200, StatusCode::CLASS_SUCCESSFUL],
            [256, StatusCode::CLASS_SUCCESSFUL],
            [299, StatusCode::CLASS_SUCCESSFUL],
            [300, StatusCode::CLASS_REDIRECTION],
            [312, StatusCode::CLASS_REDIRECTION],
            [399, StatusCode::CLASS_REDIRECTION],
            [400, StatusCode::CLASS_CLIENT_ERROR],
            [442, StatusCode::CLASS_CLIENT_ERROR],
            [499, StatusCode::CLASS_CLIENT_ERROR],
            [500, StatusCode::CLASS_SERVER_ERROR],
            [512, StatusCode::CLASS_SERVER_ERROR],
            [599, StatusCode::CLASS_SERVER_ERROR],
        ];
    }
}
