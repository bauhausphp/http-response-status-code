<?php

namespace Bauhaus\Http\Response;

class StatusCode implements StatusCodeInterface
{
    private $code = null;

    public function __construct(int $code)
    {
        $this->code = $code;
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
}
