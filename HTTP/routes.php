<?php

namespace Core;

$router = new Router();

// Static pages
$router->get('/', 'index');
$router->get('/index', 'index');
$router->get('/about', 'about');
$router->get('/contact', 'contact');
$router->get('/services', 'services');

// Notes routes
$router->get('/notes', 'NotesController/index')->only('auth');
$router->get('/notes/create', 'NotesController/create')->only('auth');
$router->post('/notes/create', 'NotesController/store')->only('auth');
$router->get('/note', 'NotesController/show')->only('auth');
$router->get('/note/edit', 'NotesController/edit')->only('auth');
$router->patch('/note', 'NotesController/update')->only('auth');
$router->delete('/note', 'NotesController/destroy')->only('auth');

// Registration routes
$router->get('/register', 'RegistrationController/register')->only('guest');
$router->post('/register', 'RegistrationController/store')->only('guest');

// Session routes
$router->get('/login', 'SessionController/login')->only('guest');
$router->post('/session', 'SessionController/store')->only('guest');
$router->delete('/session', 'SessionController/destroy')->only('auth');

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];

$router->route($uri, $method);
