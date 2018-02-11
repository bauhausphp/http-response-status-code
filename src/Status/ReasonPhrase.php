<?php

namespace Bauhaus\Http\Response\Status;

class ReasonPhrase
{
    protected $value;

    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public static function fromRegistry(Code $code, Registry $registry): self
    {
        return new self($registry->reasonPhraseFromCode($code));
    }
}
