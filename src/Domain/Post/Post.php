<?php

namespace IESLaCierva\Domain\Post;

use IESLaCierva\Domain\Post\ValueObject\Status;

class Post implements \JsonSerializable
{
    private string $postId;
    private string $title;
    private string $body;
    private \DateTimeImmutable $createdAt;
    private string $authorId;
    private Status $state;

    public function __construct(string $postId, string $title, string $body, \DateTimeImmutable $createdAt, string $authorId, Status $state) {
        $this->postId = $postId;
        $this->title = $title;
        $this->body = $body;
        $this->createdAt = $createdAt;
        $this->authorId = $authorId;
        $this->state = $state;
    }

    public static function create(string $title, string $body, string $authorId)
    {
        return new self(
            uniqid(),
            $title,
            $body,
            new \DateTimeImmutable(),
            $authorId,
            new Status(Status::PENDING)
        );
    }

    public function postId(): string
    {
        return $this->postId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }

    public function state(): Status
    {
        return $this->state;
    }

    public function publish(): void
    {
        $this->state = new Status(Status::PUBLISHED);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->postId(),
            'title' => $this->title(),
            'body' => $this->body(),
            'createdAt' => $this->createdAt()->format(DATE_ATOM),
            'userId' => $this->authorId(),
            'status' => $this->state()->value()
        ];
    }


}
