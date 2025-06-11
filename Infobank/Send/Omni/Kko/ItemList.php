<?php

namespace Infobank\Send\Omni\Kko;

class ItemList implements \JsonSerializable
{
    private $title;
    private $description;
    private $imgUrl;
    private $schemeAndroid;
    private $schemeIos;
    private $urlMobile;
    private $urlPc;

    public function __construct(string $title = null, string $description = null, string $imgUrl = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->imgUrl = $imgUrl;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): ItemList
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): ItemList
    {
        $this->description = $description;
        return $this;
    }

    public function getimgUrl(): string
    {
        return $this->imgUrl;
    }

    public function setimgUrl(string $imgUrl): ItemList
    {
        $this->imgUrl = $imgUrl;
        return $this;
    }

    public function getSchemeAndroid(): string
    {
        return $this->schemeAndroid;
    }

    public function setSchemeAndroid(string $schemeAndroid): ItemList
    {
        $this->schemeAndroid = $schemeAndroid;
        return $this;  
    }

    public function getSchemeIos(): string
    {  
        return $this->schemeIos;
    }

    public function setSchemeIos(string $schemeIos): ItemList
    {
        $this->schemeIos = $schemeIos;
        return $this;
    }

    public function getUrlMobile(): string
    {
        return $this->urlMobile;
    }

    public function setUrlMobile(string $urlMobile): ItemList
    {
        $this->urlMobile = $urlMobile;
        return $this;
    }

    public function getUrlPc(): string
    {
        return $this->urlPc;
    }

    public function setUrlPc(string $urlPc): ItemList
    {
        $this->urlPc = $urlPc;
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