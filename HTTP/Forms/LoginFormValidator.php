<?php


namespace HTTP\Forms;

use Core\Validator;

class LoginFormValidator
{
    protected array $errors = [];

    public static function validate(array $data): bool
    {
        if (Validator::email($data['email']) === false) {
            $errors['email'] = 'Invalid email address.';
        }

        return empty($errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function add(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }
}
