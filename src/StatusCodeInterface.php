<?php

namespace Bauhaus\Http\Response;

interface StatusCodeInterface
{
    public function class(): string;
    public function reasonPhrase(): string;
}
