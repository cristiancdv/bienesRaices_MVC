<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Route;

$routes = new Route(true);
$route = $routes->getRoutes();

debugear($route);
