<?php

namespace Infobank\Send\Omni;

class ResponseDestinations implements \JsonSerializable
{
    private $to;
    private $msgKey;
    private $code;
    private $result;

    public function __construct(
        $to,
        $msgKey,
        $code,
        $result
    ){
        $this->to = $to;
        $this->msgKey = $msgKey;
        $this->code = $code;
        $this->result = $result;
    }

    /**
     * @return string 수신번호
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string 메시지 키
     */
    public function getMsgKey(): string
    {
        return $this->msgKey;
    }

    /**
     * @return string 접수 결과 코드
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string 접수 결과 설명
     */
    public function getResult(): string
    {
        return $this->result;
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