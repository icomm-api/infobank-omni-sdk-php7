<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;

class CarouselTail implements \JsonSerializable
{
    private $urlPc;
    private $urlMobile;
    private $schemeIos;
    private $schemeAndroid;

    public function getUrlPc(): string
    {
        return $this->urlPc;
    }

    public function setUrlPc(string $urlPc): CarouselTail
    {
        $this ->urlPc = $urlPc;
        return $this;
    }

    public function getUrlMobile(): string
    {
        return $this->urlMobile;
    }

    public function setUrlMobile(string $urlMobile): CarouselTail
    {
        $this ->urlMobile = $urlMobile;
        return $this;
    }

    public function getSchemeIos(): string
    {
        return $this->schemeIos;
    }

    public function setSchemeIos(string $schemeIos): CarouselTail
    {
        $this ->schemeIos = $schemeIos;
        return $this;
    }

    public function getSchemeAndroid(): string
    {
        return $this->schemeAndroid;
    }

    public function setSchemeAndroid(string $schemeAndroid): CarouselTail
    {   
        $this ->schemeAndroid = $schemeAndroid;
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