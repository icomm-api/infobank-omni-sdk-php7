<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Send\Omni\QuickReply;

class Supplement implements \JsonSerializable
{
    private $quickReply;

    /**
     * @param array $quickReply 카카오 버튼 정보(최대 5개) array(Infobank/Send/Kko/KkoButton ...)
     */
    public function __construct(array $quickReply){
        $this->quickReply = $quickReply;
    }

    /**
     * @return array 카카오 버튼 정보(최대 5개) array(Infobank/Send/Kko/KkoButton ...)
     */
    public function getQuickReply(): array
    {
        return $this->quickReply;
    }

    /**
     * @param \Infobank\Send\Kko\KkoButton $button 카카오 버튼 정보
     * @return $this
     */
    public function addQuickReply(QuickReply $quickReply): Supplement
    {
        $this->quickReply[] = $quickReply;
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