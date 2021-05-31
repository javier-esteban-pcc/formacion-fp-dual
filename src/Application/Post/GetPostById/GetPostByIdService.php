<?php

namespace IESLaCierva\Application\Post\GetPostById;

use IESLaCierva\Domain\Post\Exceptions\PostNotFound;
use IESLaCierva\Domain\Post\Post;
use IESLaCierva\Domain\Post\PostRepository;

class GetPostByIdService
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {

        $this->postRepository = $postRepository;
    }

    public function execute(string $postId): Post
    {
        $post = $this->postRepository->findById($postId);
        if ($post === null) {
            throw new PostNotFound();
        }

        return $post;
    }
}
