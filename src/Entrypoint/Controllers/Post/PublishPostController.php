<?php

namespace IESLaCierva\Entrypoint\Controllers\Post;

use IESLaCierva\Application\Post\GetAllPost\GetAllPost;
use IESLaCierva\Application\Post\PublishPost\PublishPost;
use IESLaCierva\Infrastructure\Files\JsonPaymentRepository;
use IESLaCierva\Infrastructure\Files\JsonPostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PublishPostController
{
    public function execute(Request $request): Response
    {
        $service = new PublishPost(new JsonPostRepository(), new JsonPaymentRepository());
        $service->execute($request->get('postId'));
        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
