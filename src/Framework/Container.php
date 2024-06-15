<?php

namespace App\Framework;
use Exception;
use ReflectionClass;

class Container
{
    private $services = [];

    public function set($name, $value)
    {
        $this->services[$name] = $value;
    }

    public function get($name)
    {
        if (!isset($this->services[$name])) {
            return $this->autoResolve($name);
        }

        return $this->services[$name];
    }

    private function autoResolve($name)
    {
        $reflectionClass = new ReflectionClass($name);

        if (!$reflectionClass->isInstantiable()) {
            throw new Exception("Class {$name} is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();

        if (is_null($constructor)) {
            return new $name;
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    private function getDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if ($dependency === null) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Cannot resolve class dependency {$parameter->name}");
                }
            } else {
                $dependencies[] = $this->get($dependency->name);
            }
        }

        return $dependencies;
    }
}