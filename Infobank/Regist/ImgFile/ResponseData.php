<?php

namespace Infobank\Regist\ImgFile;

class ResponseData implements \JsonSerializable
{
    private $imgUrl;
    private $fileKey;
    private $media;
    private $expired;

    public function __construct($imgUrl, $fileKey, $media, $expired)
    {
        $this->imgUrl = $imgUrl;
        $this->fileKey = $fileKey;
        $this->media = $media;
        $this->expired = $expired;
    }

    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    public function getFileKey(): string
    {
        return $this->fileKey;
    }

    public function getMedia(): string
    {
        return $this->media;
    }

    public function getExpired(): string
    {
        return $this->expired;
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
