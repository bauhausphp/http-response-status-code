<?php

namespace Bauhaus\Http\Response;

use PHPUnit\Framework\TestCase;

class StatusCodeTest extends TestCase
{
    /**
     * @test
     * @dataProvider codesAndTheyConvertedToInteger
     */
    public function storeProvidedCodeAsInteger($code, int $expectedCode)
    {
        $statusCode = new StatusCode($code);

        $this->assertSame($expectedCode, $statusCode->code());
    }

    public function codesAndTheyConvertedToInteger()
    {
        return [
            [404, 404],
            ['200', 200],
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
     * @dataProvider codesAndTheirClasses
     */
    public function classifyItselfAccordingToRfc7231($code, $expectedClass)
    {
        $statusCode = new StatusCode($code);

        $class = $statusCode->class();

        $this->assertEquals($expectedClass, $class);
    }

    public function codesAndTheirClasses()
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
     * @dataProvider codesAndReasonPhrasesIanaRegistered
     */
    public function chooseReasonPhraseFromIanaRegistryIfNoneWasProvided(
        int $code,
        string $expectedReasonPhrase
    ) {
        $statusCode = new StatusCode($code);

        $reasonPhrase = $statusCode->reasonPhrase();

        $this->assertEquals($expectedReasonPhrase, $reasonPhrase);
    }

    public function codesAndReasonPhrasesIanaRegistered()
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

    /**
     * @test
     */
    public function noReasonPhraseIsChosenIfNoneWasProvidedAndItIsNotIanaRegistered()
    {
        $statusCode = new StatusCode(599);

        $this->assertNull($statusCode->reasonPhrase());
    }

    /**
     * @test
     */
    public function allowReasonPhraseCustomizationByProvidingItOnConstructor()
    {
        $customReasonPhrase = 'My custom Reason Phrase';

        $statusCode = new StatusCode(200, $customReasonPhrase);

        $this->assertEquals($customReasonPhrase, $statusCode->reasonPhrase());
    }
}
