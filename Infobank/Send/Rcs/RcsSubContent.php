<?php

declare(strict_types=1);

namespace Infobank\Send\Rcs;

class RcsSubContent implements \JsonSerializable
{
    private $subTitle;
    private $subDesc;
    private $subMedia;
    private $subMediaUrl;

    /**
     * @param $subTitle
     * @param $subDesc
     * @param $subMedia
     * @param $subMediaUrl
     */
    public function __construct($subTitle, $subDesc, $subMedia, $subMediaUrl)
    {
        $this->subTitle = $subTitle;
        $this->subDesc = $subDesc;
        $this->subMedia = $subMedia;
        $this->subMediaUrl = $subMediaUrl;
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