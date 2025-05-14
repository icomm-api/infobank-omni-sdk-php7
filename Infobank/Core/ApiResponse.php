<?php

declare(strict_types=1);

namespace Infobank\Core;

abstract class ApiResponse
{
    protected $httpCode;
    protected $code = null;
    protected $result = null;

    public function __construct($httpCode, $json)
    {
        $this->httpCode = $httpCode;
        $this->jsonDeserialize($json);
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getResult()
    {
        return $this->result;
    }
}