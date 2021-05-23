<?php

namespace IESLaCierva\Entrypoint\Controllers\User;

use IESLaCierva\Application\User\GetUserById\GetUserByIdService;
use IESLaCierva\Infrastructure\Files\CsvUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUserByIdController
{
    public function execute(Request $request): Response
    {
        $file = fopen('./../src/Infrastructure/Files/users.csv', "r");
        if (false === $file) {
            throw new Exception('File not found');
        }

        $userId = $request->get('id');

        if (null === $userId) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        $user = [];

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            if ($data[0] === $userId) {
                $user = [
                        'id' => $data[0],
                        'name' => $data[1],
                        'email' => $data[2],
                        'role' => $data[4]
                    ];
            }
        }

        fclose($file);
        return new JsonResponse($user, count($user) ? Response::HTTP_OK : Response::HTTP_NOT_FOUND);

    }

}
