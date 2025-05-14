<?php

namespace Infobank\Send;

use Infobank\Send\Omni\ResponseData;

class ApiResponse extends \Infobank\Core\ApiResponse implements \JsonSerializable
{
    private $msgKey; // simple 발송
    private $data; // omni 발송
    private $ref;

    public function __construct($httpCode, $json)
    {
        $this->httpCode = $httpCode;
        $this->jsonDeserialize($json);
    }

    /**
     * @return string simple 발송 API호출 결과 데이터
     */
    public function getMsgKey(): string
    {
        return $this->msgKey;
    }

    /**
     * @return ResponseData omni 발송 API호출 결과 데이터
     */
    public function getData(): ResponseData
    {
        return new ResponseData($this->data);
    }

    /**
     * @return string 참조필드(요청 시 입력한 데이터)
     */
    public function getRef(): string
    {
        return $this->ref;
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