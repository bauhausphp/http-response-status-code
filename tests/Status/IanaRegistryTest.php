<?php

namespace Bauhaus\Http\Response\Status;

use PHPUnit\Framework\TestCase;

class IanaRegistryTest extends TestCase
{
    private $ianaRegistry;

    protected function setUp()
    {
        $this->ianaRegistry = new IanaRegistry();
    }

    /**
     * @test
     * @dataProvider ianaRegistryCodesAndExpectedReasonPhrases
     */
    public function returnReasonPhraseGivenARegisteredCode(
        int $code,
        string $expected
    ) {
        $reasonPhrase = $this->ianaRegistry->reasonPhrase($code);

        $this->assertEquals($expected, $reasonPhrase);
    }

    public function ianaRegistryCodesAndExpectedReasonPhrases()
    {
        return [
            'Code 100' => [100, 'Continue'],
            'Code 101' => [101, 'Switching Protocols'],
            'Code 102' => [102, 'Processing'],
            'Code 200' => [200, 'OK'],
            'Code 201' => [201, 'Created'],
            'Code 202' => [202, 'Accepted'],
            'Code 203' => [203, 'Non-Authoritative Information'],
            'Code 204' => [204, 'No Content'],
            'Code 205' => [205, 'Reset Content'],
            'Code 206' => [206, 'Partial Content'],
            'Code 207' => [207, 'Multi-Status'],
            'Code 208' => [208, 'Already Reported'],
            'Code 226' => [226, 'IM Used'],
            'Code 300' => [300, 'Multiple Choices'],
            'Code 301' => [301, 'Moved Permanently'],
            'Code 302' => [302, 'Found'],
            'Code 303' => [303, 'See Other'],
            'Code 304' => [304, 'Not Modified'],
            'Code 305' => [305, 'Use Proxy'],
            'Code 307' => [307, 'Temporary Redirect'],
            'Code 308' => [308, 'Permanent Redirect'],
            'Code 400' => [400, 'Bad Request'],
            'Code 401' => [401, 'Unauthorized'],
            'Code 402' => [402, 'Payment Required'],
            'Code 403' => [403, 'Forbidden'],
            'Code 404' => [404, 'Not Found'],
            'Code 405' => [405, 'Method Not Allowed'],
            'Code 406' => [406, 'Not Acceptable'],
            'Code 407' => [407, 'Proxy Authentication Required'],
            'Code 408' => [408, 'Request Timeout'],
            'Code 409' => [409, 'Conflict'],
            'Code 410' => [410, 'Gone'],
            'Code 411' => [411, 'Length Required'],
            'Code 412' => [412, 'Precondition Failed'],
            'Code 413' => [413, 'Payload Too Large'],
            'Code 414' => [414, 'URI Too Long'],
            'Code 415' => [415, 'Unsupported Media Type'],
            'Code 416' => [416, 'Range Not Satisfiable'],
            'Code 417' => [417, 'Expectation Failed'],
            'Code 421' => [421, 'Misdirected Request'],
            'Code 422' => [422, 'Unprocessable Entity'],
            'Code 423' => [423, 'Locked'],
            'Code 424' => [424, 'Failed Dependency'],
            'Code 426' => [426, 'Upgrade Required'],
            'Code 428' => [428, 'Precondition Required'],
            'Code 429' => [429, 'Too Many Requests'],
            'Code 431' => [431, 'Request Header Fields Too Large'],
            'Code 451' => [451, 'Unavailable For Legal Reasons'],
            'Code 500' => [500, 'Internal Server Error'],
            'Code 501' => [501, 'Not Implemented'],
            'Code 502' => [502, 'Bad Gateway'],
            'Code 503' => [503, 'Service Unavailable'],
            'Code 504' => [504, 'Gateway Timeout'],
            'Code 505' => [505, 'HTTP Version Not Supported'],
            'Code 506' => [506, 'Variant Also Negotiates'],
            'Code 507' => [507, 'Insufficient Storage'],
            'Code 508' => [508, 'Loop Detected'],
            'Code 510' => [510, 'Not Extended'],
            'Code 511' => [511, 'Network Authentication Required'],
        ];
    }

    /**
     * @test
     */
    public function returnNullGivenANotRegisteredCode()
    {
        $this->assertNull($this->ianaRegistry->reasonPhrase(599));
    }
}
