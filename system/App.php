<?php

namespace System;

use App\Http\Middleware\RedirectMiddleware;
use System\Contract\MiddlewareInterface;

class App
{
    private static $instances = [];

    public function make(Container $container, Route $route, $httpMethod, $uri, Config $config)
    {
        if (!isset(static::$instances['db'])) {
            $database = $config->config()['database'];
            static::$instances['db'] = (new DB($database))->getInstance();
        }

        if (!isset(static::$instances['session'])) {
            static::$instances['session'] = new Session;
            static::$instances['session']->start();
        }
        $container->bind(MiddlewareInterface::class, fn(Container $container)=> new RedirectMiddleware(new Auth));
        echo $route->dispatch(strtolower($httpMethod), $uri);
    }

    public function __get($name)
    {
        if (isset(static::$instances[$name])) return static::$instances[$name];
    }
}
