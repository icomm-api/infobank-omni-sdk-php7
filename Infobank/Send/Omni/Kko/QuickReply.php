<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Send\Kko\KkoButtonType;

class QuickReply implements \JsonSerializable
{
    private $type;
    private $name;
    private $urlPc;
    private $urlMobile;
    private $schemeIos;
    private $schemeAndroid;
    private $chatExtra;
    private $chatEvent;
    private $bizFormId;

    public function __construct(KkoButtonType $type, string $name){
        $this->type = $type;
        $this->name = $name;
    }
    
    public function getUrlPc() : string
    {
        return  $this->urlPc;
    }

    public function setUrlPc(string $urlPc) : QuickReply
    {
        $this->urlPc = $urlPc;
        return $this;
    }

    public function getUrlMobile() : string
    {
        return $this->urlMobile;
    }

    public function setUrlMobile(string $urlMobile) : QuickReply
    {
        $this->urlMobile = $urlMobile;
        return $this;
    }

    public function getSchemeIos() : string
    {
        return $this->schemeIos;
    }

    public function setSchemeIos(string $schemeIos) : QuickReply
    {
        $this->schemeIos = $schemeIos;
        return $this;
    }

    public function getSchemeAndroid() : string
    {
        return $this->schemeAndroid;
    }

    public function setSchemeAndroid(string $schemeAndroid) : QuickReply
    {
        $this->schemeAndroid = $schemeAndroid;
        return $this;
    }

    public function getChatExtra() : string
    {
        return $this->chatExtra;
    }

    public function setChatExtra(string $chatExtra) : QuickReply
    {
        $this->chatExtra = $chatExtra;
        return $this;
    }
    
    public function getChatEvent() : string
    {
        return $this->chatEvent;
    }

    public function setChatEvent(string $chatEvent) : QuickReply
    {
        $this->chatEvent = $chatEvent;
        return $this;
    }

    public function getBizFormId() : string
    {
        return $this->bizFormId;
    }

    public function setBizFormId(string $bizFormId) : QuickReply
    {
        $this->bizFormId = $bizFormId;
        return  $this;
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