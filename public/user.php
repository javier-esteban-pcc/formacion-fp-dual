<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $file = fopen('./../src/Infrastructure/Files/users.csv', "r");
    if (false === $file) {
        throw new Exception('File not found');
    }

    if (count($_GET) === 0) {
        header('Content-Type: application/json');
        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            echo json_encode(
                [
                    'id' => $data[0],
                    'name' => $data[1],
                    'email' => $data[2],
                    'role' => $data[4]
                ]
            );
        }
        http_response_code(200);
    }

    if (isset($_GET['id'])) {
        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            if ($data[0] === $_GET['id']) {
                header('Content-Type: application/json');
                echo json_encode(
                    [
                        'id' => $data[0],
                        'name' => $data[1],
                        'email' => $data[2],
                        'role' => $data[4]
                    ]
                );
            }
        }

        http_response_code(404);
    } else {
        http_response_code(400);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = fopen('./../src/Infrastructure/Files/users.csv', "a");
    if (false === $file) {
        throw new Exception('File not found');
    }
    $data = json_decode(@file_get_contents('php://input'), true);

    if (isset($data['name']) && isset($data['email'])  && isset($data['password']) && isset($data['role'])) {
        if (in_array($data['role'], ['Administrador', 'Editor']) === false) {
            http_response_code(400);
            echo "Role not allowed";
        } else {
            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                fputcsv($file, [uniqid(), $data['name'], $data['email'], $data['password'], $data['role']]);
                http_response_code(201);
            } else {
                http_response_code(400);
                echo "Email not valid";
            }
        }
    } else {
        http_response_code(400);
    }
}  else {
    http_response_code(400);
}

fclose($file);

