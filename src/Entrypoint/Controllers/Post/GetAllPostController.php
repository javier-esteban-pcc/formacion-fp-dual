<?php

namespace IESLaCierva\Entrypoint\Controllers\Post;

use IESLaCierva\Application\Post\GetAllPost\GetAllPost;
use IESLaCierva\Infrastructure\Files\JsonPostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetAllPostController
{
    public function execute(Request $request): Response
    {
        $service = new GetAllPost(new JsonPostRepository());
        return new JsonResponse($service->execute());
    }
}
