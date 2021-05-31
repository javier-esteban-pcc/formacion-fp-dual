<?php

namespace IESLaCierva\Infrastructure\Files;

use IESLaCierva\Domain\Payment\Payment;
use IESLaCierva\Domain\Payment\ValueObject\Amount;
use IESLaCierva\Domain\Post\Post;
use IESLaCierva\Domain\Post\ValueObject\Status;

class JsonPaymentRepository implements \IESLaCierva\Domain\Payment\PaymentRepository
{
    private array $payments = [];

    public function __construct()
    {
        $payments =  json_decode(file_get_contents(__DIR__.'/payments.json'), true);
        foreach ((array) $payments as $payment) {
            $this->payments[$payment['id']] = new Payment(
                $payment['id'],
                $payment['userId'],
                $payment['postId'],
                new Amount($payment['amount']),
                new \DateTimeImmutable($payment['createdAt'])
            );
        }
    }

    public function findById(string $paymentId): ?Payment
    {
        return $this->payments[$paymentId] ?? null;
    }

    public function findAll(): array
    {
        return $this->payments;
    }

    public function save(Payment $payment): void
    {
        $this->payments[$payment->paymentId()] = $payment;

        $file = fopen(__DIR__.'/payments.json', 'w');
        fwrite($file, json_encode(array_values($this->payments)));
        fclose($file);
    }

    public function findByAuthor(string $authorId): array
    {
        $result = [];
        /** @var Payment $payment */
        foreach ($this->payments as $payment) {
            if ($payment->authorId() === $authorId) {
                $result[] = $payment;
            }
        }

        return $result;
    }

    public function findByPostId(string $postId): ?Payment
    {
        /** @var Payment $payment */
        foreach ($this->payments as $payment) {
            if ($payment->postId() === $postId) {
                return  $payment;
            }
        }

        return null;
    }
}
