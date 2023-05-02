<?php

namespace System;

class ControllerInvoker
{
    private $container;
    
    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function __invoke($controller) 
    {
        $dependencies = [];

        if ($controller instanceof \Closure) {
            $reflection = new \ReflectionFunction($controller);
        }else{
            $reflection = new \ReflectionMethod($controller[0], $controller[1]);
        }
        $parameters = $reflection->getParameters();

        if($parameters){
            foreach ($parameters as $parameter) {
                $type = $parameter->getType();
                if($type && !$type->isBuiltin()) {
                    $dependencies[] = $this->container->resolve($type->getName());
                }
            }
            
        }
        return call_user_func_array($controller instanceof \Closure ? $controller : [$controller[0], $controller[1]], $dependencies);
    }
}