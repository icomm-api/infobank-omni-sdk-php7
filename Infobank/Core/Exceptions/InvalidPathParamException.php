<?php

namespace Infobank\Core\Exceptions;

class InvalidPathParamException extends \InvalidArgumentException
{
    public function __construct($message = "", $code = 0) {
        parent::__construct($message, $code);
    }
}