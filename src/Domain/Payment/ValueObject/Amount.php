<?php

namespace IESLaCierva\Domain\Payment\ValueObject;

use IESLaCierva\Domain\Payment\Exceptions\AmountNotValid;

class Amount
{
    private float $amount;
    const AMOUNT_PER_CHARACTER = 0.02;

    public function __construct(float $amount) {
        if ($amount < 0) {
            throw new AmountNotValid();
        }
        $this->amount = round($amount,2);
    }

    public function value(): float
    {
        return $this->amount;
    }

    public static function fromNumberOfCharacters(int $numberOfCharacters)
    {
        return new self($numberOfCharacters*self::AMOUNT_PER_CHARACTER);
    }
}
