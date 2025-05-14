<?php

namespace Infobank\Auth;

class ApiResponse extends \Infobank\Core\ApiResponse implements \JsonSerializable
{
    private $data;

    public function __construct($httpCode, $json)
    {
        $this->httpCode = $httpCode;
        $this->jsonDeserialize($json);
    }

    public function getData(): TokenData
    {
        return new TokenData(json_encode($this->data));
    }

    public function jsonDeserialize($jsonString) {
        $data = json_decode($jsonString, true);

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function jsonSerialize(): array
    {
        $vars = get_object_vars($this);
        $filteredVars = [];

        foreach ($vars as $key => $value) {
            if ($value !== null) {
                $filteredVars[$key] = $value;
            }
        }

        return $filteredVars;
    }
}