<?php

declare(strict_types=1);

namespace Infobank\Send\Inter;

class InterMessage implements \JsonSerializable
{
    private $from;
    private $to;
    private $text;
    private $ref;

    public function __construct(string $from, string $to, string $text)
    {
        $this->from = $from;
        $this->to = $to;
        $this->text = $text;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
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