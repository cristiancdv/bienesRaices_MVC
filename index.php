<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

$routes = new Router(true);
$route = $routes->getRoutes();

debugear($route);
