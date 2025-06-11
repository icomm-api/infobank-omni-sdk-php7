<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;

class Link implements \JsonSerializable
{
    private $urlPc;
    private $urlMobile;
    private $schemeAndroid;
    private $schemeIos;
    

    public function __construct(string $urlPc, string $urlMobile)
    {
        $this->urlPc = $urlPc;
        $this->urlMobile = $urlMobile;
    }


    public function getUrlPc(): string
    {
        return $this->urlPc;
    }

    /**
     * @param string $urlPc
     * @return $this
     */
    public function setUrlPc(string $urlPc): Link
    {
        $this->urlPc = $urlPc;
        return $this;
    }

    
    public function getUrlMobile(): string
    {
        return $this->urlMobile;
    }

    /**
     * @param string $urlMobile
     * @return $this
     */
    public function setUrlMobile(string $urlMobile): Link
    {
        $this->urlMobile = $urlMobile;
        return $this;
    }

    
    public function getSchemeAndroid(): string
    {
        return $this->schemeAndroid;
    }

    /**
     * @param string $schemeAndroid
     * @return $this
     */
    public function setSchemeAndroid(string $schemeAndroid): Link
    {
        $this->schemeAndroid = $schemeAndroid;
        return $this;
    }

    
    public function getSchemeIos(): string
    {
        return $this->schemeIos;
    }

    /**
     * @param string $schemeIos
     * @return $this
     */
    public function setSchemeIos(string $schemeIos): Link
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