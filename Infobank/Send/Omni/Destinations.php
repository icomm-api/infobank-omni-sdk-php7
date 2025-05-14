<?php

namespace Infobank\Send\Omni;

class Destinations implements \JsonSerializable
{
    private $to;
    private $replaceWords;

    /**
     * 통합 발송 Destinations 인스턴트
     *
     * @param string $to 수신번호
     * @param json object | null $replaceWords 치환 문구(JSON Object)
     */
    public function __construct(
        string $to,
        $replaceWords = null
    ){
        $this->to=$to;
        $this->replaceWords = $replaceWords;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    public function getReplaceWords()
    {
        return $this->replaceWords;
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