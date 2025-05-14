<?php

declare(strict_types=1);

namespace Infobank\Send\Omni;

class SmsMessage implements \JsonSerializable
{
    private $from;
    private $text;
    private $ttl;
    private $originCID;

    public function __construct(string $from, string $text)
    {
        $this->from = $from;
        $this->text = $text;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTtl(): string
    {
        return $this->ttl;
    }

    public function setTtl($ttl): SmsMessage
    {
        $this->ttl = $ttl;
        return $this;
    }

    public function getOriginCID(): string
    {
        return $this->originCID;
    }

    public function setOriginCID($originCID): SmsMessage
    {
        $this->originCID = $originCID;
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