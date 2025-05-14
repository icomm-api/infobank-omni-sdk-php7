<?php

declare(strict_types=1);

namespace Infobank\Send\Rcs;

use Infobank\Core\Exceptions\InvalidRcsException;

class RcsTemplate implements \JsonSerializable
{
    private $description;
    private $subContent;

    public function add($key, $value): RcsTemplate
    {
        $this->{$key} = $value;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description): RcsTemplate
    {
        $this->description = $description;
        return $this;
    }

    public function getSubContent(){
        return $this->subContent;
    }

    /**
     * @param array $subContents 서브 컨텐트 정보 array(Infobank\Rcs\Models\RcsSubContent ...)
     * @return $this
     */
    public function setSubContent(array $subContents): RcsTemplate
    {
        foreach ($subContents as $item) {
            if (!$item instanceof RcsSubContent) {
                throw new InvalidRcsException('subContents array must contain instances of RcsSubContent.');
            }
        }
        $this->subContent = $subContents;
        return $this;
    }

    /**
     * @param RcsSubContent $subContent 서브 컨텐트 정보
     * @return $this
     */
    public function addSubContent(RcsSubContent $subContent): RcsTemplate
    {
        $this->subContent[] = $subContent;
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