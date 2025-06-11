<?php

namespace Infobank\Send\Omni\Kko;

use Infobank\Core\Exceptions\InvalidOmniException;

class Commerce implements \JsonSerializable
{
    private $title;
    private $regularPrice;
    private $discountPrice;
    private $discountRate;
    private $discountFixed;

    public function __construct(string $title, int $regularPrice){
        $this->title = $title;
        $this->regularPrice = $regularPrice;
    }
    
     public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Commerce
    {
        $this->title = $title;
        return $this;
    }

    public function getRegularPrice(): int
    {
        return $this->regularPrice;
    }

    public function setRegularPrice(int $regularPrice):Commerce
    {
        $this->regularPrice = $regularPrice;
        return $this;
    }

    public function getDiscountPrice(): int
    {
        return $this->discountPrice;
    }

    public function setDiscountPrice(int $discountPrice):Commerce
    {
        $this->discountPrice = $discountPrice;
        return $this;
    }

    public function getDiscountFixed(): int
    {
        return $this->discountFixed;
    }

    public function setDiscountFixed(int $discountFixed):Commerce
    {
        $this->discountFixed = $discountFixed;
        return $this;
    }

    public function getDiscountRate(): int
    {
        return $this->discountRate;
    }

    public function setDiscountRate(int $discountRate):Commerce
    {
        $this->discountRate = $discountRate;
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