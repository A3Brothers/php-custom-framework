<?php
namespace System;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface {
    private $bindings = [];

    public function get(string $id)
    {
        return $this->resolve($id);
    }

    public function has(string $id): bool 
    {
        return isset($this->bindings[$id]);
    }

    public function bind($abstract, $concrete = null) {
        if ($concrete === null) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = is_callable($concrete) ? $concrete($this) : $concrete;
    }

    public function resolve($abstract) {
        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];
        } else {
            $concrete = $abstract;
        }

        if (is_object($concrete)) {
            return $concrete;
        }

        $reflection = new \ReflectionClass($concrete);
        
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new $concrete();
        }

        $parameters = $constructor->getParameters();

        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();

            if ($type === null) {
                throw new \Exception("Cannot resolve parameter {$parameter->getName()} of class {$concrete}");
            }

            if ($type->isBuiltin() && !$type instanceof \ReflectionNamedType) {
                throw new \Exception("Cannot resolve built-in parameter {$parameter->getName()} of class {$concrete}");
            }
            
            $dependency = $this->resolve($type->getName());

            $dependencies[] = $dependency;
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}
