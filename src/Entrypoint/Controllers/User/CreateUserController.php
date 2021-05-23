<?php

namespace IESLaCierva\Entrypoint\Controllers\User;

use IESLaCierva\Application\User\CreateNewUser\CreateNewUserService;
use IESLaCierva\Infrastructure\Files\CsvUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    public function execute(Request $request): Response
    {
        $data = json_decode(@file_get_contents('php://input'), true);

        if (isset($data['name']) && isset($data['email'])  && isset($data['password']) && isset($data['role'])) {
            if (in_array($data['role'], ['Administrador', 'Editor']) === false) {
                return new JsonResponse(["error" => "Role not allowed"], Response::HTTP_BAD_REQUEST);
            } else {
                if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $file = fopen('./../src/Infrastructure/Files/users.csv', "a");
                    if (false === $file) {
                        throw new Exception('File not found');
                    }
                    fputcsv($file, [uniqid(), $data['name'], $data['email'], $data['password'], $data['role']]);
                    fclose($file);
                    return new JsonResponse([], Response::HTTP_CREATED);
                } else {
                    return new JsonResponse(["error" => "email not valid"], Response::HTTP_BAD_REQUEST);
                }
            }
        } else {
            return new JsonResponse(["error" => "Missing parameters"], Response::HTTP_BAD_REQUEST);
        }
    }
}
