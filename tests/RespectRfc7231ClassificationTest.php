<?php

namespace Bauhaus\Http\Response;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Bauhaus\Http\Response\Status\Classification;

class RespectRfc7231ClassificationTest extends TestCase
{
    /**
     * @test
     * @dataProvider codesAndTheirClassification
     */
    public function returnClassificationAccordingToGivenCode($code, $expectedClass)
    {
        $status = Status::create($code);

        $this->assertEquals($expectedClass, $status->class());
    }

    public function codesAndTheirClassification(): array
    {
        return [
            'Informational 100' => [100, Classification::INFORMATIONAL],
            'Informational 128' => [128, Classification::INFORMATIONAL],
            'Informational 199' => [199, Classification::INFORMATIONAL],
            'Successful 200' => [200, Classification::SUCCESSFUL],
            'Successful 256' => [256, Classification::SUCCESSFUL],
            'Successful 299' => [299, Classification::SUCCESSFUL],
            'Redirection 300' => [300, Classification::REDIRECTION],
            'Redirection 312' => [312, Classification::REDIRECTION],
            'Redirection 399' => [399, Classification::REDIRECTION],
            'Client Error 400' => [400, Classification::CLIENT_ERROR],
            'Client Error 442' => [442, Classification::CLIENT_ERROR],
            'Client Error 499' => [499, Classification::CLIENT_ERROR],
            'Servier Error 500' => [500, Classification::SERVER_ERROR],
            'Servier Error 512' => [512, Classification::SERVER_ERROR],
            'Servier Error 599' => [599, Classification::SERVER_ERROR],
        ];
    }
}
