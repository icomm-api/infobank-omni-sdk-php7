<?php

namespace Infobank\Core\Exceptions;

class InvalidOmniException extends \InvalidArgumentException
{
    public function __construct($message = "", $code = 0) {
        parent::__construct($message, $code);
    }
}