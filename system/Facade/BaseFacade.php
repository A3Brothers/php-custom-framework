<?php

namespace System\Facade;

use System\Container;

abstract class BaseFacade
{
    protected static $resolvedInstance;

    protected static $container = null;

    protected static function getFacadeAccessor()
    {
        throw new \RuntimeException(static::class . ' does not implement getFacadeAccessor method.');
    }

    public static function __callStatic($method, $arguments)
    {
        
        $instance = static::resolveFacadeInstance(static::getFacadeAccessor());
        return $instance->$method(...$arguments);
    }

    protected static function resolveFacadeInstance($accessor)
    {
        
        if (is_object($accessor)) {
            return static::$resolvedInstance = $accessor;
        }

        if (isset($GLOBALS[$accessor])) {
            return static::$resolvedInstance = $GLOBALS[$accessor];
        }

        if (class_exists($accessor)) {
            static::$container = static::$container ?? new Container;
            return static::$resolvedInstance = static::$container->get($accessor);
        }

        throw new \RuntimeException("Facade accessor '{$accessor}' does not exist.");
    }
}
