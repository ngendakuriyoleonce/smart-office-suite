<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class OpenCodeAI extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'open-code-ai';
    }
}
