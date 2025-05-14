<?php

namespace Infobank\Core\Exceptions;

class AuthenticationException extends \Exception{
    public function __construct($message = "", $code = 0) {
        parent::__construct($message, $code);
    }
}