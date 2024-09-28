<?php

use Core\Response;

function dd(mixed $value): never
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function url_is(string $url): bool
{
    return $_SERVER['REQUEST_URI'] === $url;
}

function base_path(string $path = ''): string
{
    $BASE_PATH = dirname(__DIR__);
    $BASE_PATH .= $path ? DIRECTORY_SEPARATOR . $path : $path;

    if (DIRECTORY_SEPARATOR === '/') {
        return $BASE_PATH;
    }

    $BASE_PATH = str_replace('/', DIRECTORY_SEPARATOR, $BASE_PATH);
    return $BASE_PATH;
}

function view(string $view, array $data = []): void
{
    extract($data);
    $base_path = base_path("views/{$view}.view.php");
    require $base_path;
}

function abort(int $code = Response::NOT_FOUND,): void
{
    http_response_code($code);
    view($code);
    die();
}
