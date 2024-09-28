<?php

use Core\{App, Database};
use Core\Session;
use HTTP\Forms\LoginFormValidator;

$db = App::resolve(Database::class);

$pageTitle = "Login";

$data = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
];

$loginValidator = new LoginFormValidator();

if ($loginValidator->validate($data)) {
    $user = $db->fetchOne('SELECT * FROM users WHERE email = :email', ['email' => $data['email']]);

    if ($user && password_verify($data['password'], $user['password'])) {
        Session::set('userID', $user['id']);
        header('Location: /notes');
        exit;
    }

    $loginValidator->add('login', 'Invalid email or password.');
}

Session::flash('old', $data);

Session::flash('errors', $loginValidator->errors());

header('Location: /login');
exit;
