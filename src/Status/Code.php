<?php

namespace Bauhaus\Http\Response\Status;

use InvalidArgumentException;

class Code
{
    private const LOWER_LIMIT = 100;
    private const UPPER_LIMIT = 599;

    private $value;

    public function __construct(int $value)
    {
        $isInvalid = $value < self::LOWER_LIMIT || $value > self::UPPER_LIMIT;

        if ($isInvalid) {
            throw new InvalidArgumentException("The status code '$value' is invalid");
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
