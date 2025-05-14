<?php

namespace Infobank\Send\Rcs;

use Infobank\Send\Fallback;

class RCSFallback extends Fallback implements \JsonSerializable
{
    /**
     * RCSFallback 인스턴트
     *
     * 아래 페이지에서 상세 내용 확인이 가능합니다.
     *
     * https://infobank-guide.gitbook.io/omni-api-specification/api-reference/send/rcs#fallback
     *
     * fallback 메시지는 SMS/MMS만 가능합니다.
     *
     * @param string $type Fallback 종류(SMS, MMS) ) \Infobank\Rcs\Models\RCSFallbackType
     * @param string $text 메시지 내용
     * @param string|null $title 메시지 제목
     * @param array $fileKey
     * @param string|null $originCID
     */
    public function __construct(
        string $type,
        string $text,
        string $title = null,
        array  $fileKey = [],
        string $originCID = null
    ){
        $this->type = $type;
        $this->text = $text;
        $this->title = $title;
        $this->fileKey = $fileKey;
        $this->originCID = $originCID;
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