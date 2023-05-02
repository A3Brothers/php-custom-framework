<?php

namespace System;

use System\ControllerInvoker;

class Route
{
    public static $routes = [];

    public static function get($path, $handler)
    {
        self::$routes['get'][$path] = $handler;
    }

    public static function post($path, $handler)
    {
        self::$routes['post'][$path] = $handler;

    }

    public static function dispatch($httpMethod, $uri)
    {
        if(isset(self::$routes[$httpMethod][$uri])) {
            $handler = self::$routes[$httpMethod][$uri];
            $container = new Container();
            $invokable = new ControllerInvoker($container);
            $invokable($handler);
            return;
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
