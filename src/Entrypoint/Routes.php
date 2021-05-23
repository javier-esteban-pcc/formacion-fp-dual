<?php

namespace IESLaCierva\Entrypoint;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
    private RouteCollection $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection();
        $this->configureRoutes();
    }

    private function configureRoutes()
    {
        $this->addRoute(
            'home',
            '/home',
            '\IESLaCierva\Entrypoint\Controllers\HomeController::execute',
            ['GET']
        );

    }

    public function getRoutes()
    {
        return $this->routes;
    }

    private function addRoute(string $name, string $path, string $controller, array $methods)
    {
        $this->routes->add(
            $name,
            new Route(
                $path,
                [
                    '_controller' => $controller,
                ],
                [],
                [],
                null,
                [],
                $methods
            )
        );
    }
}
