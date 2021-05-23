<?php

namespace IESLaCierva\Entrypoint\Controllers\User;

use IESLaCierva\Application\User\GetAllUsers\GetAllUserService;
use IESLaCierva\Infrastructure\Files\CsvUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetAllUsersController
{

    public function execute(Request $request): Response
    {
        $file = fopen('./../src/Infrastructure/Files/users.csv', "r");
        if (false === $file) {
            throw new Exception('File not found');
        }

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            $users[] = [
                    'id' => $data[0],
                    'name' => $data[1],
                    'email' => $data[2],
                    'role' => $data[4]
                ];
        }

        return new JsonResponse($users);
    }
}
