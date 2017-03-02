<?php

namespace Bauhaus\Http\Response;

interface StatusCodeInterface
{
    public function code(): int;
    public function class(): string;
    public function reasonPhrase(): ?string;
}
