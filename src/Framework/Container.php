<?php

namespace App\Framework;
use Exception;
use ReflectionClass;

class Container
{
    private $services = [];

    public function __construct()
    {
        $this->set(\App\Framework\TemplateEngine::class, function () {
            return new \App\Framework\TemplateEngine('src/App/View/');
        });

        $this->set(\App\Framework\Response::class, function () {
            return new \App\Framework\Response('src/App/View/');
        });

        $this->set(\App\App\Model\Card::class, function () {
            return new \App\App\Model\Card();
        });

        $this->set(\App\App\Model\User::class, function () {
            // De User klasse heeft een constructor die parameters verwacht. Voorbeeldwaarden zijn gebruikt.
            return new \App\App\Model\User(null, 'username', 'email@example.com', 'password', false);
        });

        $this->set(\App\App\Model\UserRole::class, function () {
            return new \App\App\Model\UserRole();
        });

        $this->set(\App\App\Controller\CardController::class, function ($container) {
            return new \App\App\Controller\CardController(
                $container->get(\App\Framework\Response::class),
                $container->get(\App\App\Model\Card::class),
                $container->get(\App\App\Model\User::class),
                $container->get(\App\App\Model\UserRole::class)
            );
        });
    }
    

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