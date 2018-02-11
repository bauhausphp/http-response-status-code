<?php

namespace Bauhaus\Http\Response;

use Bauhaus\Http\Response\Status\Code;
use Bauhaus\Http\Response\Status\ReasonPhrase;
use Bauhaus\Http\Response\Status\Registry;
use Bauhaus\Http\Response\Status\IanaRegistry;
use Bauhaus\Http\Response\Status\Classification;

class Status
{
    private $code;
    private $reasonPhrase;

    private function __construct(Code $code, ReasonPhrase $reasonPhrase)
    {
        $this->code = $code;
        $this->reasonPhrase = $reasonPhrase;
    }

    public function code(): int
    {
        return $this->code->value();
    }

    public function reasonPhrase(): ?string
    {
        return $this->reasonPhrase->value();
    }

    public function class(): string
    {
        return new Classification($this->code);
    }

    public function __toString(): string
    {
        $code = $this->code();
        $reasonPhrase = $this->reasonPhrase();

        return $reasonPhrase ? "$code $reasonPhrase" : "$code";
    }

    public static function create(int $code, string $reasonPhrase = ''): self
    {
        if (empty($reasonPhrase)) {
            return self::createWithRegistry($code, new IanaRegistry());
        }

        return new self(new Code($code), new ReasonPhrase($reasonPhrase));
    }

    public static function createWithRegistry(int $code, Registry $registry): self
    {
        $code = new Code($code);
        $reasonPhrase = ReasonPhrase::fromRegistry($code, $registry);

        return new self($code, $reasonPhrase);
    }
}
