<?php

namespace App\Core;

use Psr\Container\ContainerInterface;

class DependencyInjectionContainer implements ContainerInterface
{
    private $instances = [];

    public function get($id)
    {
        if (!isset($this->instances[$id])) {
            $this->instances[$id] = new $id();
        }

        return $this->instances[$id];
    }

    public function has($id)
    {
        return isset($this->instances[$id]);
    }
}
