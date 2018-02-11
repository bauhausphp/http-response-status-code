<?php

namespace Bauhaus\Http\Response;

use PHPUnit\Framework\TestCase;
use Bauhaus\Http\Response\Status\Registry;

class CustomizeReasonPhraseTest extends TestCase
{
    /**
     * @test
     */
    public function allowReasonPhraseCustomization()
    {
        $customReasonPhrase = 'Custom Reason Phrase';

        $status = Status::create(200, $customReasonPhrase);

        $this->assertEquals($customReasonPhrase, $status->reasonPhrase());
    }

    /**
     * @test
     */
    public function allowUsageOfCustomRegistry()
    {
        $stubRegistry = $this->createMock(Registry::class);
        $stubRegistry
            ->method('reasonPhraseFromCode')
            ->willReturn('From Custom Registry');

        $status = Status::createWithRegistry(200, $stubRegistry);

        $this->assertEquals('From Custom Registry', $status->reasonPhrase());
    }
}
