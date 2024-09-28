<?php

namespace Core;

class Session
{
    public static function get(string $key, $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function flash(string $key, $value): void
    {
        $_SESSION['flashed'][$key] = $value;
    }

    public static function getFlashed(string $key, $default = null): mixed
    {
        return $_SESSION['flashed'][$key] ?? $default;
    }

    public static function unflash(): void
    {
        unset($_SESSION['flashed']);
    }

    public static function flush(): void
    {
        $_SESSION = [];
    }

    private static function expireSessionCookie(): void
    {
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                isset($_SERVER['HTTPS']),
                true // Ensure secure flag is set
            );
        }
    }

    public static function destroy(): void
    {
        self::expireSessionCookie();
        session_destroy();
    }
}
