<?php
namespace IESLaCierva\Entrypoint;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes {
    private RouteCollection $routes;

    public function __construct() {
        $this->routes = new RouteCollection();
        $this->configureRoutes();
    }

    private function configureRoutes()
    {
        $this->addRoute(
            'get_all_users',
            '/users',
            '\IESLaCierva\Entrypoint\Controllers\User\GetAllUsersController::execute',
            ['GET']
        );

        $this->addRoute(
            'get_user_by_id',
            '/users/{userId}',
            '\IESLaCierva\Entrypoint\Controllers\User\GetUserByIdController::execute',
            ['GET']
        );

        $this->addRoute(
            'create_user',
            '/users',
            '\IESLaCierva\Entrypoint\Controllers\User\CreateUserController::execute',
            ['POST']
        );

    }

    public function getRoutes()
    {
        return $this->routes;
    }

    private function addRoute(string $name, string $path, string $controller, array $methods) {
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
