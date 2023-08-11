<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BaseFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return static::class;
    }

    /**
     * @param $class
     * @return void
     */
    public static function shouldProxyTo($class): void
    {
        app()->bind(self::getFacadeAccessor(), $class);
    }
}
