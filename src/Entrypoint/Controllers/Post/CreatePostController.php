<?php

namespace IESLaCierva\Entrypoint\Controllers\Post;

use IESLaCierva\Application\Post\CreatePost\CreatePost;
use IESLaCierva\Infrastructure\Files\CsvUserRepository;
use IESLaCierva\Infrastructure\Files\JsonPostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreatePostController
{
    public function execute(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $service = new CreatePost(new JsonPostRepository(), new CsvUserRepository());
        $service->execute($data['title'], $data['body'], $data['authorId']);
    }
}
