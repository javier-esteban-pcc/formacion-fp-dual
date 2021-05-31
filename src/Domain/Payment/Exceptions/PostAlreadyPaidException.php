<?php

namespace IESLaCierva\Domain\Payment\Exceptions;

use IESLaCierva\Domain\Exceptions\ParameterNotValid;
use Throwable;

class PostAlreadyPaidException extends \Exception implements ParameterNotValid
{
    public function __construct(string $postId)
    {
        parent::__construct("Post with id {$postId} has been paid already");
    }
}
