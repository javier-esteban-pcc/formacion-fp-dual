<?php

namespace IESLaCierva\Application\Post\PublishPost;

use IESLaCierva\Domain\Payment\Exceptions\PostAlreadyPaidException;
use IESLaCierva\Domain\Payment\Payment;
use IESLaCierva\Domain\Payment\PaymentRepository;
use IESLaCierva\Domain\Payment\ValueObject\Amount;
use IESLaCierva\Domain\Post\Exceptions\PostNotFound;
use IESLaCierva\Domain\Post\PostRepository;

class PublishPost
{
    private PostRepository $postRepository;
    private PaymentRepository $paymentRepository;

    public function __construct(PostRepository $postRepository, PaymentRepository $paymentRepository)
    {
        $this->postRepository = $postRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function execute(string $postId) {
        $post = $this->postRepository->findById($postId);
        if ($post === null) {
            throw new PostNotFound();
        }

        $post->publish();
        $this->postRepository->save($post);

        $previousPayment = $this->paymentRepository->findByPostId($postId);
        if (null !== $previousPayment) {
            throw new PostAlreadyPaidException($postId);
        }

        $payment = Payment::create(
            $post->authorId(),
            $post->postId(),
            Amount::fromNumberOfCharacters( strlen( $post->body()))
        );

        $this->paymentRepository->save($payment);
    }
}
