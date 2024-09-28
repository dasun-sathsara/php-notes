<?php


namespace Core;

use Core\Container;

class App
{
    protected static $container;

    public static function init(): void
    {
        if (!self::$container) {
            self::$container = new Container();
        }

        // Start the session
        session_start();
    }

    public static function bind(string $name, $builder): void
    {
        self::$container->bind($name, $builder);
    }

    public static function resolve(string $name): mixed
    {
        return self::$container->resolve($name);
    }
}
