<?php

namespace IESLaCierva\Infrastructure\Files;

use IESLaCierva\Domain\Post\Post;
use IESLaCierva\Domain\Post\PostRepository;
use IESLaCierva\Domain\Post\ValueObject\Status;

class JsonPostRepository implements PostRepository
{

    private array $posts = [];

    public function __construct()
    {
        $posts =  json_decode(file_get_contents(__DIR__.'/posts.json'), true);
        foreach ((array) $posts as $post) {
            $this->posts[$post['id']] = new Post(
                $post['id'],
                $post['title'],
                $post['body'],
                new \DateTimeImmutable($post['createdAt']),
                $post['userId'],
                new Status($post['status'])
            );
        }


    }

    public function findById(string $postId): ?Post
    {
        return $this->posts[$postId] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->posts);
    }

    public function save(Post $post): void
    {
        $this->posts[$post->postId()] = $post;

        $file = fopen(__DIR__.'/posts.json', 'w');
        fwrite($file, json_encode(array_values($this->posts)));
        fclose($file);
    }


}
