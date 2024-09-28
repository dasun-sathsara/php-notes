<?php

use Core\Session;

Session::flush();

Session::destroy();

// Redirect the user to login page or home
header('Location: /login');
exit;
