<?php

declare(strict_types=1);

namespace Infobank\Send\Mms;

class MmsMessage implements \JsonSerializable
{
    private $from;
    private $to;
    private $text;
    private $title;
    private $fileKey;
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

    public function setFrom($from): MmsMessage
    {
        $this->from = $from;
        return $this;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function setTo($to): MmsMessage
    {
        $this->to = $to;
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

    public function getRef(): string
    {
        return $this->ref;
    }

    public function setRef(string $ref): MmsMessage
    {
        $this->ref = $ref;
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