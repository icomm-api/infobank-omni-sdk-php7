<?php

namespace Infobank\Send\Omni;

class MmsMessage implements \JsonSerializable
{
    private $from;
    private $text;
    private $title;
    private $fileKey;
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

    public function setFrom($from): MmsMessage
    {
        $this->from = $from;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): MmsMessage
    {
        $this->text = $text;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): MmsMessage
    {
        $this->title = $title;
        return $this;
    }

    public function getFileKey(): array
    {
        return $this->fileKey;
    }

    public function setFileKey(array $fileKey): MmsMessage
    {
        $this->fileKey = $fileKey;
        return $this;
    }

    public function getTtl(): string
    {
        return $this->ttl;
    }

    public function setTtl(string $ttl): MmsMessage
    {
        $this->ttl = $ttl;
        return $this;
    }

    public function getOriginCID(): string
    {
        return $this->originCID;
    }

    public function setOriginCID(string $originCID): MmsMessage
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