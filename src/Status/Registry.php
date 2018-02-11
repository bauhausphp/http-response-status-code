<?php

namespace Bauhaus\Http\Response\Status;

interface Registry
{
    public function reasonPhrase(int $code): ?string;
}
