<?php

namespace Infobank\Send\Rcs;

use Infobank\Core\Exceptions\InvalidRcsException;

class RcsCarousel implements \JsonSerializable
{
    private $text;
    private $title;
    private $media;
    private $mediaUrl;
    private $button;

    public function getText(

    ){
        return $this->text;
    }

    public function setText(
        $text
    ){
        $this->text = $text;
        return $this;
    }

    public function getTitle(

    ){
        return $this->title;
    }

    public function setTitle(
        $title
    ){
        $this->title = $title;
        return $this;
    }

    public function getMedia(

    ){
        return $this->media;
    }

    public function setMedia(
        $media
    ){
        $this->media = $media;
        return $this;
    }

    public function getMediaUrl(

    ){
        return $this->mediaUrl;
    }

    public function setMediaUrl(
        $mediaUrl
    ){
        $this->mediaUrl = $mediaUrl;
        return $this;
    }

    public function getButton(

    ){
        return $this->button;
    }

    public function getSubContent(

    ){
        return $this->subContent;
    }

    /**
     * @param array $button 버튼 정보 array(Infobank\Send\RcsButton ...)
     * @return RcsStandAlone
     */
    public function setButton(
        array $buttons
    ){
        foreach ($buttons as $item) {
            if (!$item instanceof RcsButton) {
                throw new InvalidRcsException('Button array must contain instances of RcsButton.');
            }
        }
        $this->button = $buttons;
        return $this;
    }

    /**
     * @param RcsButton $button 버튼 정보
     * @return $this
     */
    public function addButton(
        RcsButton $button
    ){
        $this->button[] = $button;
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