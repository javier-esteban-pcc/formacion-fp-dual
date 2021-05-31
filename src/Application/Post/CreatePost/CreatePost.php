<?php

namespace IESLaCierva\Application\Post\CreatePost;

use IESLaCierva\Domain\Post\Post;
use IESLaCierva\Domain\Post\PostRepository;
use IESLaCierva\Domain\User\Exceptions\UserNotFoundException;
use IESLaCierva\Domain\User\UserRepository;

class CreatePost
{
    private PostRepository $postRepository;
    private UserRepository $userRepository;

    public function __construct(PostRepository $postRepository, UserRepository $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function execute(string $title, string $body, string $authorId)
    {
        $author = $this->userRepository->findById($authorId);
        if ($author === null) {
            throw new UserNotFoundException();
        }

        $post = Post::create($title, $body, $authorId);
        $this->postRepository->save($post);
    }
}
