<?php

declare(strict_types=1);

namespace Infobank\Send\Rcs;

use Infobank\Core\Exceptions\InvalidRcsException;

class RcsStandAlone implements \JsonSerializable
{
    private $text;
    private $title;
    private $media;
    private $mediaUrl;
    private $button;
    private $subContent;

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

    /**
     * @param array $subContents 서브 컨텐트 정보 array(Infobank\Send\RcsSubContent ...)
     * @return $this
     */
    public function setSubContent(
        array $subContents
    ){
        foreach ($subContents as $item) {
            if (!$item instanceof RcsSubContent) {
                throw new InvalidRcsException('subContents array must contain instances of RcsSubContent.');
            }
        }
        $this->subContent = $subContents;
        return $this;
    }

    /**
     * @param RcsSubContent $subContent 서브 컨텐트 정보
     * @return $this
     */
    public function addSubContent(
        RcsSubContent $subContent
    ){
        $this->subContent[] = $subContent;
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