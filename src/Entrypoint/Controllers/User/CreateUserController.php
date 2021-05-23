<?php

namespace IESLaCierva\Entrypoint\Controllers\User;

use IESLaCierva\Application\User\CreateNewUser\CreateNewUserService;
use IESLaCierva\Infrastructure\Files\CsvUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    private CreateNewUserService $service;

    public function __construct()
    {
        $this->service = new CreateNewUserService(new CsvUserRepository());
    }

    public function execute(Request $request): Response
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        $this->service->execute($data['name'], $data['email'], $data['password'], $data['role']);
        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
