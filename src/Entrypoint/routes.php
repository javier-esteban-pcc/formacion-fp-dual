<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


$routes = new RouteCollection();
$routes->add(
    'home',
    new Route(
        '/home',
        ['_controller' => '\IESLaCierva\Entrypoint\Controllers\HomeController::execute']
    )
);


return $routes;