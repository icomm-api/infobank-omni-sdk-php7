<?php

declare(strict_types=1);

namespace Infobank\Send\Sms;

class SmsMessage implements \JsonSerializable
{
    private $from;
    private $to;
    private $text;
    private $ref;
    private $originCID;

    public function __construct(string $from, string $to, string $text)
    {
        $this->from = $from;
        $this->to = $to;
        $this->text = $text;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getRef(): string
    {
        return $this->ref;
    }

    public function setRef($ref): SmsMessage
    {
        $this->ref = $ref;
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