<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/../vendor/autoload.php';

const PAGES_PATH = __DIR__.'/../src/pages/';

$request = Request::createFromGlobals();
$response = new Response();
 
$map = [
    '/home' => PAGES_PATH.'home.php',
    '/article' => PAGES_PATH.'article.php',
    '/user'  => PAGES_PATH.'user.php',
];

$path = $request->getPathInfo();
if (isset($map[$path])) {
    ob_start();
    include $map[$path];
    $response->setContent(ob_get_clean());
} else {
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response->send();