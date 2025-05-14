<?php

namespace Infobank\Send\Kko;

class KkoButton implements \JsonSerializable
{
    private $type;
    private $name;
    private $urlPc;
    private $urlMobile;
    private $schemeIos;
    private $schemeAndroid;
    private $chatExtra;
    private $chatEvent;
    private $bizFormKey;
    private $bizFormId;

    public function getType():string
    {
        return $this->type;
    }

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function makeWlButton(
        $urlMobile,
        $urlPc = null
    ): KkoButton
    {
        $this->type = KkoButtonType::WL;
        $this->urlMobile = $urlMobile;
        $this->urlPc = $urlPc;

        return $this;
    }

    public function makeAlButton(
        $schemeAndroid,
        $schemeIos = null,
        $urlMobile = null,
        $urlPc = null
    ): KkoButton
    {
        $this->type = KkoButtonType::AL;
        $this->schemeAndroid = $schemeAndroid;
        $this->schemeIos = $schemeIos;
        $this->urlMobile = $urlMobile;
        $this->urlPc = $urlPc;

        return $this;
    }

    public function makeBkButton(): KkoButton
    {
        $this->type = KkoButtonType::BK;

        return $this;
    }

    public function makeMdButton(): KkoButton
    {
        $this->type = KkoButtonType::MD;

        return $this;
    }

    public function makeDsButton(): KkoButton
    {
        $this->type = KkoButtonType::DS;

        return $this;
    }

    public function makeBcButton(
        $chatExtra = null
    ): KkoButton
    {
        $this->type = KkoButtonType::BC;
        $this->chatExtra = $chatExtra;

        return $this;
    }

    public function makeBtButton(
        $chatExtra = null,
        $chatEvent = null
    ): KkoButton
    {
        $this->type = KkoButtonType::BC;
        $this->chatExtra = $chatExtra;
        $this->chatEvent = $chatEvent;

        return $this;
    }

    public function makeAcButton(): KkoButton
    {
        $this->type = KkoButtonType::AC;
        return $this;
    }

    public function makeBfButton(
        $bizFormKey = null,
        $bizFormId = null
    ): KkoButton
    {
        $this->type = KkoButtonType::BF;
        $this->bizFormKey = $bizFormKey;
        $this->bizFormId = $bizFormId;

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