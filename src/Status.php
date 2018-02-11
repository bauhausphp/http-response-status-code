<?php

namespace Bauhaus\Http\Response;

use Bauhaus\Http\Response\Status\Code;
use Bauhaus\Http\Response\Status\Classification;
use Bauhaus\Http\Response\Status\Registry;
use Bauhaus\Http\Response\Status\IanaRegistry;

class Status
{
    private $code;
    private $reasonPhrase;

    private function __construct(int $code, ?string $reasonPhrase)
    {
        $this->code = new Code($code);
        $this->reasonPhrase = $reasonPhrase;
    }

    public function code(): int
    {
        return $this->code->value();
    }

    public function reasonPhrase(): ?string
    {
        return $this->reasonPhrase;
    }

    public function class(): string
    {
        return new Classification($this->code);
    }

    public static function create(int $code, string $reasonPhrase = ''): self
    {
        if (empty($reasonPhrase)) {
            return self::createWithRegistry($code, new IanaRegistry());
        }

        return new self($code, $reasonPhrase);
    }

    public static function createWithRegistry(int $code, Registry $registry): self
    {
        $reasonPhrase = $registry->reasonPhrase($code);

        return new self($code, $reasonPhrase);
    }
}
