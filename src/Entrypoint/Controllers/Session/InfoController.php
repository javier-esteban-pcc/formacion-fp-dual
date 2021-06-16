<?php

namespace IESLaCierva\Entrypoint\Controllers\Session;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InfoController
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
