<?php

namespace IESLaCierva\Entrypoint\Controllers\Api\User;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionController
{
    public function execute(Request $request): Response
    {
        return new JsonResponse([
                'email' => $_SESSION['email'] ?? null,
                'role' => $_SESSION['role'] ?? null,
                'name' => $_SESSION['name'] ?? null,
            ]);
    }
}
