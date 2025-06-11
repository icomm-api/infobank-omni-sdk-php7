<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidKkoException;
use Infobank\Core\Exceptions\InvalidOmniException;

class Carousel implements \JsonSerializable
{
    private $head;
    private $list;
    private $tail;

    public function __construct(array $list){
        foreach ($list as $item) {
            if (!$item instanceof CarouselList) {
                throw new InvalidOmniException('list array must contain instances of AttachmentItemList.');
            }
        }
        $this->list = $list;
    }

    public function getHead(): CarouselHead
    {
        return $this->head;
    }

    public function setHead(CarouselHead $head): Carousel
    {
        $this->head = $head;
        return $this;
    }

    /**
     * @param CarouselList $list 카카오 버튼 정보
     * @return $this
     */
    public function addList(CarouselList $list): Carousel
    {
        $this->list[] = $list;
        return $this;
    }

    
    /**
     * @param array 카카오 버튼 정보(최대 5개)
     * @return $this
     */
    public function setList(
        array $lists
    ): Carousel
    {
        foreach ($lists as $list) {
            if (!$list instanceof CarouselList) {
                throw new InvalidKkoException('Button array must contain instances of KkoButton.');
            }
        }
        $this->list = $lists;
        return $this;
    }


    /**
     * @param array $list 아이템 리스트(2~10 개) array(AttachmentItemList ...)
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    


    public function getTail(): CarouselTail
    {
        return $this->tail;
    }

    public function setTail(CarouselTail $tail): Carousel
    {
        $this->tail = $tail;
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