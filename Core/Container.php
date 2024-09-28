<?php


namespace Core;

use Exception;

class Container
{
    private $services;
    private $resolved;

    public function __construct(array $services = [])
    {
        $this->services = $services;
        $this->resolved = [];
    }

    public function bind(string $name, $builder): void
    {
        $this->services[$name] = $builder;
    }

    public function resolve(string $name)
    {
        if (isset($this->resolved[$name])) {
            return $this->resolved[$name];
        }

        if (isset($this->services[$name])) {
            $this->resolved[$name] = $this->services[$name]();
            return $this->resolved[$name];
        } else {
            throw new Exception("Service $name not found.");
        }
    }
}
