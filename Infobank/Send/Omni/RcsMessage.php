<?php

namespace Infobank\Send\Omni;

use Infobank\Send\Rcs\RcsContent;

class RcsMessage implements \JsonSerializable
{
    private $content;
    private $from;
    private $formatId;
    private $brandKey;

    private $brandId;
    private $groupId;
    private $expiryOption;
    private $copyAllowed;
    private $header;
    private $footer;
    private $agencyId;
    private $agencyKey;
    private $ttl;

    public function __construct(RCSContent $content, $from, $formatId, $brandKey)
    {
        $this->content = $content;
        $this->from = $from;
        $this->formatId = $formatId;
        $this->brandKey = $brandKey;
    }

    public function setBrandId($brandId): RcsMessage
    {
        $this->brandId = $brandId;
        return $this;
    }

    public function setGroupId($groupId): RcsMessage
    {
        $this->groupId = $groupId;
        return $this;
    }

    public function setExpiryOption($expiryOption): RcsMessage
    {
        $this->expiryOption = $expiryOption;
        return $this;
    }

    public function setCopyAllowed($copyAllowed): RcsMessage
    {
        $this->copyAllowed = $copyAllowed;
        return $this;
    }


    public function setHeader($header): RcsMessage
    {
        $this->header = $header;
        return $this;
    }

    public function setFooter($footer): RcsMessage
    {
        $this->footer = $footer;
        return $this;
    }

    public function setAgencyId($agencyId): RcsMessage
    {
        $this->agencyId = $agencyId;
        return $this;
    }

    public function setAgencyKey($agencyKey): RcsMessage
    {
        $this->agencyKey = $agencyKey;
        return $this;
    }

    public function setTtl($ttl): RcsMessage
    {
        $this->ttl = $ttl;
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