<?php

namespace IESLaCierva\Domain\Post\ValueObject;

use IESLaCierva\Domain\Post\Exceptions\statusNotValidException;

class Status
{
    private string $status;
    const PENDING = 'Pending';
    const PUBLISHED = 'Published';

    public function __construct(string $status)
    {
        if (in_array($status, [self::PENDING, self::PUBLISHED]) === false) {
            throw new statusNotValidException();
        }
        $this->status = $status;
    }

    public function value(): string
    {
        return $this->status;
    }
}
