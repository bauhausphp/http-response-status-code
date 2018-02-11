<?php

namespace Bauhaus\Http\Response;

use PHPUnit\Framework\TestCase;

class BuildStatusLineTest extends TestCase
{
    /**
     * @test
     * @dataProvider statusAndExpectedStatusLines
     */
    public function buildStatusLineFromToStringMagicMethod(
        Status $status,
        string $expected
    ) {
        $statusLine = $status->__toString();

        $this->assertEquals($expected, $statusLine);
    }

    public function statusAndExpectedStatusLines()
    {
        return [
            [Status::create(200), '200 OK'],
            [Status::create(455, 'Custom Reason Phrase'), '455 Custom Reason Phrase'],
            [Status::create(599), '599'],
        ];
    }
}
