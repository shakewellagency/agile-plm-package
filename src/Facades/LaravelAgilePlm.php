<?php

namespace Shakewell\LaravelAgilePlm\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Shakewell\LaravelAgilePlm\LaravelAgilePlm
 */
class LaravelAgilePlm extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Shakewell\LaravelAgilePlm\LaravelAgilePlm::class;
    }
}
