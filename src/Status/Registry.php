<?php

namespace Bauhaus\Http\Response\Status;

interface Registry
{
    public function reasonPhraseFromCode(Code $code): ?string;
}
