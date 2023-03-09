<?php

namespace Coxlr\Profanity\Facades;

use Illuminate\Support\Facades\Facade;

class Profanity extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'profanity';
    }
}
