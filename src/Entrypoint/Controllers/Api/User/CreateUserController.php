<?php

namespace IESLaCierva\Entrypoint\Controllers\Api\User;

use IESLaCierva\Application\User\CreateNewUser\CreateNewUserService;
use IESLaCierva\Domain\User\ValueObject\Role;
use IESLaCierva\Infrastructure\Database\MySqlUserRepository;
use IESLaCierva\Infrastructure\Files\CsvUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    private CreateNewUserService $service;

    public function __construct()
    {
        $this->service = new CreateNewUserService(new MySqlUserRepository());
    }

    public function execute(Request $request): Response
    {
        $this->service->execute($request->get('name'), $request->get('email'), $request->get('password'), $request->get('role') ?? Role::EDITOR);
        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
