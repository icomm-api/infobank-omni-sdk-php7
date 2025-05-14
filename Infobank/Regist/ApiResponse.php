<?php

namespace Infobank\Regist;


class ApiResponse extends \Infobank\Core\ApiResponse implements \JsonSerializable
{
    private $data;

    public function __construct($httpCode, $json)
    {
        $this->httpCode = $httpCode;
        $this->jsonDeserialize($json);
    }

    public function getFileData(): \Infobank\Regist\ImgFile\ResponseData
    {
        return new \Infobank\Regist\ImgFile\ResponseData(
            isset($this->data['imgUrl']) ? $this->data['imgUrl'] : "",
            isset($this->data['fileKey']) ? $this->data['fileKey'] : "",
            isset($this->data['media']) ? $this->data['media'] : "",
            isset($this->data['expired']) ? $this->data['expired'] : ""
        );
    }

    public function getFormData(): \Infobank\Regist\Form\ResponseData
    {
        return new \Infobank\Regist\Form\ResponseData(
            isset($this->data['formId']) ? $this->data['formId'] : "",
            isset($this->data['messageForm']) ? $this->data['messageForm'] : "",
            isset($this->data['expired']) ? $this->data['expired'] : ""
        );
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