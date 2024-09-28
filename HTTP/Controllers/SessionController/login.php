<?php

use Core\Session;

$pageTitle = "Login";
$data = Session::getFlashed('old', []);
$errors = Session::getFlashed('errors', []);

$email = $data['email'] ?? '';

view('registration/login', compact(['pageTitle', 'email', 'errors']));
