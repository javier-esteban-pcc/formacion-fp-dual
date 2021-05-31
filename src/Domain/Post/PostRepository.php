<?php


namespace IESLaCierva\Domain\Post;


interface PostRepository
{
    public function findById(string $postId): ?Post;

    public function findAll(): array;

    public function save(Post $post): void;
}