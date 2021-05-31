<?php

namespace IESLaCierva\Application\Post\GetAllPost;

use IESLaCierva\Domain\Post\PostRepository;

class GetAllPost
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(): array
    {
        return $this->postRepository->findAll();
    }
}
