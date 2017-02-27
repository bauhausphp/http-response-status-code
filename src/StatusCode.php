<?php

namespace Bauhaus\Http\Response;

use InvalidArgumentException;
use Bauhaus\Http\Response\StatusCode\ReasonPhraseRegistry;

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
            $reasonPhraseRegistry = new ReasonPhraseRegistry();

            $reasonPhrase = $reasonPhraseRegistry->findByCode($code);
        }

        $this->code = $code;
        $this->reasonPhrase = $reasonPhrase;
    }

    public function class(): string
    {
        if ($this->code < 200) {
            return StatusCodeClass::INFORMATIONAL;
        }

        if ($this->code < 300) {
            return StatusCodeClass::SUCCESSFUL;
        }

        if ($this->code < 400) {
            return StatusCodeClass::REDIRECTION;
        }

        if ($this->code < 500) {
            return StatusCodeClass::CLIENT_ERROR;
        }

        return StatusCodeClass::SERVER_ERROR;
    }

    public function reasonPhrase(): ?string
    {
        return $this->reasonPhrase;
    }

    private function isCodeValid(int $code): bool
    {
        return $code >= self::CODE_LOWER_LIMIT && $code <= self::CODE_UPPER_LIMIT;
    }
}
