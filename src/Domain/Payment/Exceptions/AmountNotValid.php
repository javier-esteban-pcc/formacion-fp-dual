<?php

namespace IESLaCierva\Domain\Payment\Exceptions;

use IESLaCierva\Domain\Exceptions\ParameterNotValid;
use Throwable;

class AmountNotValid  extends \Exception implements ParameterNotValid
{
    public function __construct()
    {
        parent::__construct('Amount is not valid');
    }

}
