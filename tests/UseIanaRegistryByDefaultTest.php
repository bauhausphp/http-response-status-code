<?php

namespace Bauhaus\Http\Response;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UseIanaRegistryByDefaultTest extends TestCase
{
    /**
     * @test
     * @dataProvider ianaReasonPhrasesByCodes
     */
    public function useReasonPhraseFromIanaRegistryIfNoneIsProvided(
        int $code,
        string $ianaReasonPhrase
    ) {
        $status = Status::create($code);

        $this->assertEquals($ianaReasonPhrase, $status->reasonPhrase());
    }

    public function ianaReasonPhrasesByCodes()
    {
        return [
            'Code 100' => [100, 'Continue'],
            'Code 102' => [102, 'Processing'],
            'Code 200' => [200, 'OK'],
            'Code 201' => [201, 'Created'],
            'Code 301' => [301, 'Moved Permanently'],
            'Code 400' => [400, 'Bad Request'],
            'Code 403' => [403, 'Forbidden'],
            'Code 404' => [404, 'Not Found'],
            'Code 500' => [500, 'Internal Server Error'],
        ];
    }

    /**
     * @test
     */
    public function setNullReasonPhraseIfCodeIsNotInIanaRegistry()
    {
        $status = Status::create(599);

        $this->assertNull($status->reasonPhrase());
    }
}
