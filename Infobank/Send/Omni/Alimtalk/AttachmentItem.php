<?php

namespace Infobank\Send\Omni\Alimtalk;

use Infobank\Core\Exceptions\InvalidOmniException;

class AttachmentItem implements \JsonSerializable
{
    private $list;
    private $summary;

    public function __construct(array $list){
        foreach ($list as $item) {
            if (!$item instanceof AttachmentItemList) {
                throw new InvalidOmniException('list array must contain instances of AttachmentItemList.');
            }
        }
        $this->list = $list;
    }
    /**
     * @param array $list 아이템 리스트(2~10 개) array(AttachmentItemList ...)
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @return AttachmentItemSummary 아이템 요약정보
     */
    public function getSummary(): AttachmentItemSummary
    {
        return $this->summary;
    }

    /**
     * @param AttachmentItemSummary $summary 아이템 요약정보
     * @return $this
     */
    public function setSummary(AttachmentItemSummary $summary): AttachmentItem
    {
        $this->summary = $summary;
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