<?php

namespace Infobank\Send\Rcs;

class RcsMessage implements \JsonSerializable
{
    private $content;
    private $from;
    private $to;
    private $formatId;
    private $brandKey;

    private $brandId;
    private $expiryOption;
    private $header;
    private $footer;
    private $ref;
    private $fallback;

    public function __construct($content, $from, $to, $formatId, $brandKey)
    {
        $this->content = $content;
        $this->from = $from;
        $this->to = $to;
        $this->formatId = $formatId;
        $this->brandKey = $brandKey;
    }

    public function setBrandId($brandId): RcsMessage
    {
        $this->brandId = $brandId;
        return $this;
    }

    public function setExpiryOption($expiryOption): RcsMessage
    {
        $this->expiryOption = $expiryOption;
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

    public function setRef($ref): RcsMessage
    {
        $this->ref = $ref;
        return $this;
    }

    public function setFallback($fallback): RcsMessage
    {
        $this->fallback = $fallback;
        return $this;
    }

    public function getRef(): string
    {
        return $this->ref;
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