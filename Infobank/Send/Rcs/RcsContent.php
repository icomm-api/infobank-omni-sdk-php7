<?php

declare(strict_types=1);

namespace Infobank\Send\Rcs;

use Infobank\Core\Exceptions\InvalidRcsException;

class RcsContent implements \JsonSerializable
{
    /**
     * 3개 필드 중 1개 필수(standalone, carousel, template)
     * 2개 이상 필드 셋팅 불가.
     */
    private $standalone;
    private $carousel;
    private $template;

    public function setStandalone(RcsStandAlone $standalone): RcsContent
    {
        $this->standalone = $standalone;
        return $this;
    }

    public function setTemplate(RcsTemplate $template): RcsContent
    {
        $this->template = $template;
        return $this;
    }

    public function setCarousel(array $carousel): RcsContent
    {
        foreach ($carousel as $item) {
            if (!$item instanceof RcsCarousel) {
                throw new InvalidRcsException('carousel array must contain instances of RcsCarousel.');
            }
        }
        $this->carousel = $carousel;
        return $this;
    }

    public function getStandalone():RcsStandAlone
    {
        return $this->standalone;
    }

    public function getCarousel():RcsCarousel
    {
        return $this->carousel;
    }

    public function getTemplate():RcsTemplate
    {
        return $this->template;
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