<?php

namespace Bauhaus\Http\Response;

use InvalidArgumentException;
use Bauhaus\Http\Response\Status\Classification;
use Bauhaus\Http\Response\Status\Registry;
use Bauhaus\Http\Response\Status\IanaRegistry;

class Status
{
    private const CODE_LOWER_LIMIT = 100;
    private const CODE_UPPER_LIMIT = 599;

    private $code;
    private $reasonPhrase;

    private function __construct(int $code, ?string $reasonPhrase)
    {
        if ($this->isCodeInvalid($code)) {
            throw new InvalidArgumentException("The status code '$code' is invalid");
        }

        $this->code = $code;
        $this->reasonPhrase = $reasonPhrase;
    }

    public function code(): int
    {
        return $this->code;
    }

    public function reasonPhrase(): ?string
    {
        return $this->reasonPhrase;
    }

    public function class(): string
    {
        return new Classification($this);
    }

    private function isCodeInvalid(int $code): bool
    {
        return $code < self::CODE_LOWER_LIMIT || $code > self::CODE_UPPER_LIMIT;
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
