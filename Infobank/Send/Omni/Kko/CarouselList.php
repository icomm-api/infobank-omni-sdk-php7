<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;

class CarouselList implements \JsonSerializable
{
    private $header;
    private $message;
    private $additionalContent;
    private $attachment;

    public function getHeader(): string
    {
        return $this->header;
    }

    public function setHeader(string $header): CarouselList
    {
        $this->header = $header;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): CarouselList
    {
        $this->message = $message;
        return $this;
    }

    public function getAdditionalContent(): string
    {
        return $this->additionalContent;
    }

    public function setAdditionalContent(string $additionalContent): CarouselList
    {
        $this->additionalContent = $additionalContent;
        return $this;
    }

    public function getAttachment(): Attachment
    {
        return $this->attachment;
    }

    public function setAttachment(Attachment $attachment): CarouselList
    {   
        $this->attachment = $attachment;
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