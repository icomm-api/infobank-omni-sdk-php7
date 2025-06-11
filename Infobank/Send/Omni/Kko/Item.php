<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;

class Item implements \JsonSerializable
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
     * @return ItemSummary 아이템 요약정보
     */
    public function getSummary(): ItemSummary
    {
        return $this->summary;
    }

    /**
     * @param ItemSummary $summary 아이템 요약정보
     * @return $this
     */
    public function setSummary(ItemSummary $summary): Item
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