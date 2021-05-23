<?php

namespace IESLaCierva\Domain\User\Exceptions;

use IESLaCierva\Domain\Exceptions\NotFoundException;
use Throwable;

class UserNotFoundException extends \Exception implements NotFoundException
{
    public function __construct()
    {
        parent::__construct('User Not Found Exception');
    }
}
