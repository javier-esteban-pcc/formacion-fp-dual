<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../vendor/autoload.php';


$data = [
    1 => [
        'id' => 1,
        'name' => 'John',
        'age' => 12
    ]
];

$request = Request::createFromGlobals();

$id= $request->get('id');

$response =  new JsonResponse($data[$id]);
$response->send();