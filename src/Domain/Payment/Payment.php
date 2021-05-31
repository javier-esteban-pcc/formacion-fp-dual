<?php

namespace IESLaCierva\Domain\Payment;

use IESLaCierva\Domain\Payment\ValueObject\Amount;

class Payment implements \JsonSerializable
{
    private string $paymentId;
    private string $authorId;
    private Amount $amount;
    private \DateTimeImmutable $paymentDate;
    private string $postId;

    public function __construct(string $paymentId, string $authorId, string $postId, Amount $amount, \DateTimeImmutable $paymentDate)
    {

        $this->paymentId = $paymentId;
        $this->authorId = $authorId;
        $this->amount = $amount;
        $this->paymentDate = $paymentDate;
        $this->postId = $postId;
    }

    public static function create(string $author, string $postId, Amount $amount)
    {
        return new self(
            uniqid(),
            $author,
            $postId,
            $amount,
            new \DateTimeImmutable()
        );
    }

    public function paymentId(): string
    {
        return $this->paymentId;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }

    public function amount(): Amount
    {
        return $this->amount;
    }

    public function paymentDate(): \DateTimeImmutable
    {
        return $this->paymentDate;
    }

    public function postId(): string
    {
        return $this->postId;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->postId(),
            'amount' => $this->amount()->value(),
            'createdAt' => $this->paymentDate()->format(DATE_ATOM),
            'userId' => $this->authorId(),
            'postId' => $this->postId()
        ];
    }


}
