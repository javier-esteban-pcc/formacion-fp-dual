<?php

namespace IESLaCierva\Domain\User\ValueObject;

use IESLaCierva\Domain\User\Exceptions\EmailNotValidException;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new EmailNotValidException();
        }

        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}
