<?php

namespace Infobank\Send\Omni\Alimtalk;

use Infobank\Core\Exceptions\InvalidOmniException;
use Infobank\Send\Kko\KkoButton;

class Attachment implements \JsonSerializable
{
    private $button;
    private $item;
    private $itemHighlight;

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

    public function getItem():AttachmentItem
    {
        return $this->item;
    }

    /**
     * @param AttachmentItem $item
     * @return $this
     */
    public function setItem(AttachmentItem $item): Attachment
    {
        $this->item = $item;
        return $this;
    }

    public function getItemHighlight():AttachmentItemHighlight
    {
        return $this->itemHighlight;
    }

    /**
     * @param AttachmentItemHighlight $itemHighlight
     * @return $this
     */
    public function setItemHighlight(AttachmentItemHighlight $itemHighlight): Attachment
    {
        $this->itemHighlight = $itemHighlight;
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