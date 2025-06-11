<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;

class CarouselHead implements \JsonSerializable
{
    private $header;
    private $content;
    private $imageUrl;
    private $urlMobile;
    private $urlPc;
    private $schemeAndroid;
    private $schemeIos;


    public function __construct(string $header, string $content, string $imageUrl){
        $this->header = $header;
        $this->content = $content;
        $this->imageUrl = $imageUrl;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function setHeader(string $header): CarouselHead
    {
        $this->header = $header;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    public function setContent(string $content): CarouselHead
    {
        $this->content = $content;
        return $this;
    }
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
    
    public function setImageUrl(string $imageUrl): CarouselHead
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getUrlMobile(): string
    {
        return $this->urlMobile;
    }

    public function setUrlMobile(string $urlMobile): CarouselHead
    {
        $this->urlMobile = $urlMobile;
        return $this;
    }
    public function getUrlPc(): string
    {
        return $this->urlPc;
    }

    public function setUrlPc(string $urlPc): CarouselHead
    {
        $this->urlPc = $urlPc;
        return $this;
    }
    public function getSchemeAndroid(): string
    {
        return $this->schemeAndroid;
    }

    public function setSchemeAndroid(string $schemeAndroid): CarouselHead
    {
        $this->schemeAndroid = $schemeAndroid;
        return $this;
    }

    public function getSchemeIos(): string
    {
        return $this->schemeIos;
    }

    public function setSchemeIos(string $schemeIos): CarouselHead
    {
        $this->schemeIos = $schemeIos;
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