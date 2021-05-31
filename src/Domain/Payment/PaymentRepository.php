<?php

namespace IESLaCierva\Domain\Payment;

interface PaymentRepository
{
    public function findById(string $paymentId): ?Payment;

    public function findByAuthor(string $authorId): array;

    public function findByPostId(string $postId): ?Payment;

    public function save(Payment $payment): void;
}
