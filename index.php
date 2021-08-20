<?php

use MVC\Router;



$routes = new Router(true);
$route = $routes->getRoutes();
print_r($route);
