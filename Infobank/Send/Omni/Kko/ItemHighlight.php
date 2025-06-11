<?php

namespace Infobank\Send\Omni\Kko;

class ItemHighlight implements \JsonSerializable
{
    private $title;
    private $description;

    /**
     * @param string $title 타이틀
     * @param string $description 부가정보
     *  */
    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;

    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): ItemHighlight
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): ItemHighlight
    {
        $this->description = $description;
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