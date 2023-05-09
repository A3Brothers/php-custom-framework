<?php

namespace System;

use System\ControllerInvoker;

class Route
{
    public static $routes = [];

    public function get($path, $handler)
    {
        self::$routes['get'][$path] = $handler;
    }

    public function post($path, $handler)
    {
        self::$routes['post'][$path] = $handler;

    }

    public function dispatch($httpMethod, $uri)
    {
        if(isset(static::$routes[$httpMethod][$uri])) {
            $handler = static::$routes[$httpMethod][$uri];
            $container = new Container();
            $invokable = new ControllerInvoker($container);
            $invokable($handler);
            return;
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
