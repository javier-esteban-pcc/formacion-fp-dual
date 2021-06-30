<?php

namespace IESLaCierva\Entrypoint\Controllers\Api\User;

use IESLaCierva\Application\User\GetAllUsers\GetAllUserService;
use IESLaCierva\Infrastructure\Database\MySqlUserRepository;
use IESLaCierva\Infrastructure\Files\CsvUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetAllUsersController
{
    private GetAllUserService $getAllUserService;

    public function __construct() {
        $this->getAllUserService = new GetAllUserService(new MySqlUserRepository());
    }


    public function execute(Request $request): Response
    {
        $users = $this->getAllUserService->execute();
        return new JsonResponse($users);
    }
}
