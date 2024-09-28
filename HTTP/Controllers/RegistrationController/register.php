<?php

use Core\Session;

$pageTitle = "Register";
$errors = Session::getFlashed('errors', []);
$formData = Session::getFlashed('old', []);

$name = $formData['name'] ?? '';
$email = $formData['email'] ?? '';
$password = $formData['password'] ?? '';

view('registration/register', compact('pageTitle', 'name', 'email', 'password', 'errors'));
