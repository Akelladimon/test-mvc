<?php

use Controllers\FormController;
use Service\Router;

require_once 'Controllers/FormController.php';
require_once 'Service/Router.php';

if (session_status() == PHP_SESSION_NONE) {
    $session_timeout = 1800;
    session_set_cookie_params($session_timeout);
    session_start();

}

$router = new Router();

$router->addRoute('GET', '/', [FormController::class, 'index']);
$router->addRoute('POST', '/', [FormController::class, 'store']);
$router->addRoute('GET', '/about', [FormController::class, 'about']);

// Handle the request
$router->handleRequest();
