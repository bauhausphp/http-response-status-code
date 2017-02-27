<?php

namespace Bauhaus\Http\Response;

class StatusCode implements StatusCodeInterface
{
    const CLASS_INFORMATIONAL = 'Informational';
    const CLASS_SUCCESSFUL = 'Successful';
    const CLASS_REDIRECTION = 'Redirection';
    const CLASS_CLIENT_ERROR = 'Client Error';
    const CLASS_SERVER_ERROR = 'Server Error';

    private $code = null;

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function class(): string
    {
        if ($this->code < 200) {
            return self::CLASS_INFORMATIONAL;
        }

        if ($this->code < 300) {
            return self::CLASS_SUCCESSFUL;
        }

        if ($this->code < 400) {
            return self::CLASS_REDIRECTION;
        }

        if ($this->code < 500) {
            return self::CLASS_CLIENT_ERROR;
        }

        return self::CLASS_SERVER_ERROR;
    }
}
