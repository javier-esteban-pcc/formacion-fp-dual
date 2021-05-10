<?php

$data = [
    1 => [
        'id' => 1,
        'name' => 'John',
        'age' => 22
    ]
];

$id =  $_GET['id'] ??  null;

if ($id === null || false === isset($data[$id])) {
    http_response_code(404);
} else {
    header('Content-Type: application/json');
    echo json_encode($data[$id]);
}
