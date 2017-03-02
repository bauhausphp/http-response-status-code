<?php

namespace Bauhaus\Http\Response;

use InvalidArgumentException;
use Bauhaus\Http\Response\StatusCodeRegistry as Registry;

class StatusCode implements StatusCodeInterface
{
    private const CODE_LOWER_LIMIT = 100;
    private const CODE_UPPER_LIMIT = 599;

    private $code = null;
    private $reasonPhrase = null;

    public function __construct(int $code, string $reasonPhrase = '')
    {
        if (false === $this->isCodeValid($code)) {
            throw new InvalidArgumentException("The status code '$code' is invalid");
        }

        if ('' === $reasonPhrase) {
            $registry = new Registry();

            $reasonPhrase = $registry->findReasonPhrase($code);
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
        $firstDigit = $this->code / 100;

        return StatusCodeClass::CLASSES[$firstDigit];
    }

    private function isCodeValid(int $code): bool
    {
        return $code >= self::CODE_LOWER_LIMIT && $code <= self::CODE_UPPER_LIMIT;
    }
}
