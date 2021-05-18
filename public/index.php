<?php

use IESLaCierva\Entrypoint\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/../vendor/autoload.php';

$request = Request::createFromGlobals();
$router = new Router();
try {
    $controller = $router->execute($request);
} catch (Exception $e) {
    $response = new Response();
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response = $controller->execute($request);
$response->send();