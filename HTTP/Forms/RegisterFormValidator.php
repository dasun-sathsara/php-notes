<?php

namespace HTTP\Forms;

use Core\Validator;

class RegisterFormValidator
{
    protected $errors = [];

    public function validate(array $data): bool
    {
        if (Validator::string($data['name'], 3, 100) === false) {
            $this->errors['name'] = 'Name must be between 3 and 100 characters.';
        }

        if (Validator::email($data['email']) === false) {
            $this->errors['email'] = 'Invalid email address.';
        }

        if (Validator::string($data['password'], 8, 32)) {
            if (Validator::password($data['password']) === false) {
                $this->errors['password'] = 'Password must contain at least one digit, one lowercase letter, and one uppercase letter.';
            } else {
                if ($data['password'] !== $data['confirm-password']) {
                    $this->errors['confirm-password'] = 'Passwords do not match.';
                }
            }
        } else {
            $this->errors['password'] = 'Password must be between 8 and 32 characters.';
        }

        return empty($this->errors);
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
