<?php

namespace Core;

use Core\Response;

class Middlewares
{

    private static function auth()
    {
        if (!Session::has('userID')) {
            abort(Response::UNAUTHORIZED);
        }
    }

    private static function guest()
    {
        if (Session::has('userID')) {
            header('Location: /');
            exit();
        }
    }

    public static function resolve($key)
    {
        switch ($key) {
            case 'auth':
                self::auth();
                break;
            case 'guest':
                self::guest();
                break;
            default:
                throw new \Exception("Middleware $key not found");
        }
    }
}
