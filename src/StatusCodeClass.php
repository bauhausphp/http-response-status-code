<?php

namespace Bauhaus\Http\Response;

class StatusCodeClass
{
    const CLASSES = [
        1 => 'Informational',
        2 => 'Successful',
        3 => 'Redirection',
        4 => 'Client Error',
        5 => 'Server Error',
    ];

    const INFORMATIONAL = self::CLASSES[1];
    const SUCCESSFUL = self::CLASSES[2];
    const REDIRECTION = self::CLASSES[3];
    const CLIENT_ERROR = self::CLASSES[4];
    const SERVER_ERROR = self::CLASSES[5];
}
