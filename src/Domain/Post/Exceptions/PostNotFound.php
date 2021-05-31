<?php

namespace IESLaCierva\Domain\Post\Exceptions;

use IESLaCierva\Domain\Exceptions\NotFoundException;

class PostNotFound extends \Exception implements NotFoundException
{

}
