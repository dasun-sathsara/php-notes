<?php

use Core\{App, Database, Session};
use HTTP\Forms\RegisterFormValidator;

$db = App::resolve(Database::class);

$pageTitle = "Create an account";

$data = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'confirm-password' => $_POST['confirm-password'],
];

$registrationValidator = new RegisterFormValidator();

$user = $db->fetchOne('SELECT * FROM users WHERE email = :email', ['email' => $data['email']]);

if ($user) {
    $registrationValidator->add('email', 'Email already in use.');
} else {
    if ($registrationValidator->validate($data)) {
        try {
            $db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)', [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ]);

            header('Location: /login');
            exit;
        } catch (PDOException $e) {
            $registrationValidator->add('general', 'Something went wrong.');
        }
    }
}

Session::flash('errors', $registrationValidator->errors());
Session::flash('old', $data);

header('Location: /register');
exit;
