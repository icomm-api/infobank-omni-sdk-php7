<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;

class Video implements \JsonSerializable
{
    private $videoUrl;
    private $thumbnailUrl;

    public function __construct(string $videoUrl){
        $this->title = $videoUrl;
    }
    
     public function getVideoUrl(): string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(string $videoUrl): Video
    {
        $this->videoUrl = $videoUrl;
        return $this;
    }

    public function getThumbnailUrl(): String
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(string $thumbnailUrl):Video
    {
        $this->thumbnailUrl = $thumbnailUrl;
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