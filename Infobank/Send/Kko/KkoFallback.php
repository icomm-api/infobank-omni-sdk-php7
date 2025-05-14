<?php

namespace Infobank\Send\Kko;

use Infobank\Send\Fallback;

class KkoFallback extends Fallback implements \JsonSerializable
{
    private $from;

    /**
     * KkoFallback 인스턴트
     *
     * fallback 메시지는 SMS/MMS만 가능합니다.
     *
     * @param string $type Fallback 종류(SMS, MMS)
     * @param string $from 발신번호
     * @param string $text 메시지 내용
     * @param string|null $title 메시지 제목
     * @param array $fileKey
     * @param string|null $originCID
     */
    public function __construct(
        string $type,
        string $from,
        string $text,
        string $title = null,
        array  $fileKey = [],
        string $originCID = null
    ){
        $this->type = $type;
        $this->text = $text;
        $this->from = $from;
        $this->title = $title;
        $this->fileKey = $fileKey;
        $this->originCID = $originCID;
    }

    public function setTitle(string $title): KkoFallback
    {
        $this->title = $title;
        return $this;
    }

    public function setFileKey(array $fileKey): KkoFallback
    {
        $this->fileKey = $fileKey;
        return $this;
    }

    public function setOriginCID(string $originCID): KkoFallback
    {
        $this->originCID = $originCID;
        return $this;
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