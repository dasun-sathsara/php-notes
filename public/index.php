<?php
// Register global functions
require_once __DIR__ . '\..\HTTP\functions.php';

// Register an autoload function to automatically include class files based on their fully-qualified names
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require base_path("{$class}.php");
});

use Core\{Database, App, Session};

App::init();

App::bind('database_config', function () {
    return
        [
            "host" => "dev.dasunsathsara.com",
            "dbname" => "demo",
            "charset" => "utf8mb4",
            "port" => 3306,
            "username" => "dasun",
            "password" => "Ds20020618"
        ];
});

App::bind('Core\Database', function () {
    return new Database(App::resolve('database_config'));
});

// Routes
require base_path('HTTP/routes.php');

// Unflash
Session::unflash();
