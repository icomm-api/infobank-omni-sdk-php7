<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;
use Infobank\Send\Kko\KkoButton;

class Attachment implements \JsonSerializable
{
    private $button;
    private $item;
    private $itemHighlight;
    private $image;
    private $coupon;
    private $commerce;
    private $video;

    

    /**
     * @return array
     */
    public function getButton(): array
    {
        return $this->button;
    }

    /**
     * @param array $buttons
     * @return $this
     */
    public function setButton(array $buttons): Attachment
    {
        foreach ($buttons as $item) {
            if (!$item instanceof KkoButton && !$item instanceof \Infobank\Kko\Models\KkoButton) {
                throw new InvalidOmniException('Button array must contain instances of KkoButton.');
            }
        }
        $this->button = $buttons;
        return $this;
    }

    /**
     * @param KkoButton $button 카카오 버튼 정보
     * @return $this
     */
    public function addButton(KkoButton $button): Attachment
    {
        $this->button[] = $button;
        return $this;
    }

    public function getItem():Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function setItem(Item $item): Attachment
    {
        $this->item = $item;
        return $this;
    }

    public function getItemHighlight():ItemHighlight
    {
        return $this->itemHighlight;
    }

    /**
     * @param ItemHighlight $itemHighlight
     * @return $this
     */
    public function setItemHighlight(ItemHighlight $itemHighlight): Attachment
    {
        $this->itemHighlight = $itemHighlight;
        return $this;
    }

    public function getImage():Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     * @return $this
     */
    public function setImage(Image $image): Attachment
    {
        $this->image = $image;
        return $this;
    }

    public function getCoupon():Coupon
    {
        return $this->coupon;
    }

    /**
     * @param Coupon $coupon
     * @return $this
     */
    public function setCoupon(Coupon $coupon): Attachment
    {
        $this->coupon = $coupon;
        return $this;
    }

    public function getCommerce():Commerce
    {
        return $this->commerce;
    }

    /**
     * @param Commerce $commerce
     * @return $this
     */
    public function setCommerce(Commerce $commerce): Attachment
    {
        $this->Commerce = $commerce;
        return $this;
    }


    public function getVideo():Video
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return $this
     */
    public function setVideo(Video $video): Attachment
    {
        $this->Video = $video;
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