<?php

namespace Core;

class Validator
{
    static function string(string $value, int $min, int|float $max): bool
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validates a password based on specified criteria:
     * - At least one digit, one lowercase letter, and one uppercase letter
     */
    static function password(string $value): bool
    {
        $checks = [
            "digit" => preg_match('/\d/', $value),
            "lower" => preg_match('/[a-z]/', $value),
            "upper" => preg_match('/[A-Z]/', $value)
        ];

        foreach ($checks as $check) {
            if (!$check) {
                return false;
            }
        }

        return true;
    }
}
