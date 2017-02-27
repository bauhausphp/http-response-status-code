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

    /**
     * @test
     * @dataProvider invalidStatusCodes
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /The status code '-?\d+' is invalid/
     */
    public function invalidArgumentExceptionOccursIfInvalidCodeIsProvided($invalidCode)
    {
        new StatusCode($invalidCode);
    }

    public function invalidStatusCodes()
    {
        return [
            [-10],
            [0],
            [1],
            [99],
            [601],
            [1000],
        ];
    }

    /**
     * @test
     * @dataProvider statusCodesAndReasonPhrasesRegisteredInIana
     */
    public function chooseReasonPhraseFromIanaRegistryIfNoneWasProvided(
        int $code,
        string $expectedReasonPhrase
    ) {
        $statusCode = new StatusCode($code);

        $reasonPhrase = $statusCode->reasonPhrase();

        $this->assertEquals($expectedReasonPhrase, $reasonPhrase);
    }

    public function statusCodesAndReasonPhrasesRegisteredInIana()
    {
        return [
            [100, 'Continue'],
            [102, 'Processing'],
            [200, 'OK'],
            [201, 'Created'],
            [301, 'Moved Permanently'],
            [400, 'Bad Request'],
            [403, 'Forbidden'],
            [404, 'Not Found'],
            [500, 'Internal Server Error'],
        ];
    }
}
