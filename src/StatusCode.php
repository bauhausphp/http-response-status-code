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
            return 'Informational';
        }

        if ($this->code < 300) {
            return 'Successful';
        }

        if ($this->code < 400) {
            return 'Redirection';
        }

        if ($this->code < 500) {
            return 'Client Error';
        }

        return 'Server Error';
    }
}
