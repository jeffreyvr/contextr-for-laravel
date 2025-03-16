<?php

namespace ContextrForLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class Contextr extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'contextr';
    }
}
