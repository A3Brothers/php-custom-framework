<?php

namespace System;

class Route
{
    public function __construct(private Container $container)
    {

    }
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
            
            if ($handler instanceof \Closure) {
                return call_user_func($handler, []);
                
            }else{
                [$class, $method] = $handler;
                $obj = $this->container->get($class);

                return call_user_func_array([$obj, $method], []);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
