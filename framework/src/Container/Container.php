<?php

namespace Somecode\Framework\Container;

use Psr\Container\ContainerInterface;
use Somecode\Framework\Container\Exceptions\ContainerException;

class Container implements ContainerInterface
{
    private array $services = [];

    public function add(string $id, string|object|null $concrete = null)
    {
        if (is_null($concrete)) {
            if (! class_exists($id)) {
                throw new ContainerException("Service $id not found");
            }
            $concrete = $id;
        }
        $this->services[$id] = $concrete;
    }

    public function get(string $id)
    {
        if (! $this->has($id)) {
            if (! class_exists($id)) {
                throw new ContainerException("Service $id could not be resolved");
            }
            $this->add($id);
        }
        $instance = $this->resolve($this->services[$id]);

        return $instance;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }
}
