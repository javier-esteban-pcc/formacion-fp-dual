<?php

namespace IESLaCierva\Domain\User\Exceptions;

use IESLaCierva\Domain\Exceptions\ParameterNotValid;
use Throwable;

class EmailNotValidException extends \Exception implements ParameterNotValid
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Email not valid');
    }
}
