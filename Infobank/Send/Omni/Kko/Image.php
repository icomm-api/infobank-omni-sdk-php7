<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;

class Image implements \JsonSerializable
{
    private $imgUrl;
    private $imgLink;

    public function __construct(string $imgUrl){
        $this->imgUrl = $imgUrl;
    }

    public function getImageUrl(): string
    {
        return $this->imgUrl;
    }

    public function setImageUrl(string $imgUrl): Image
    {
        $this->imgUrl = $imgUrl;
        return $this;
    }

    public function getImgLink(): string
    {
        return $this->imgLink;
    }

    public function setImgLink(string $imgLink): Image
    {
        $this->imgLink = $imgLink;
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