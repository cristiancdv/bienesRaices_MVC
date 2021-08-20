<?php

use MVC\Router;

require_once dirname(__FILE__) . "/Router.php";

$routes = new Router(true);
$route = $routes->getRoutes();

debugear($route);
