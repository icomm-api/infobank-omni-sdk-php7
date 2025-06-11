<?php

namespace Infobank\Send\Kko;

use Infobank\Core\Exceptions\InvalidKkoException;

class KkoSubType
{
    public static function validSubType($subType){
        switch($subType){
            case KkoSubTypeEnum::FIRST:
            case KkoSubTypeEnum::MIDDLE:
            case KkoSubTypeEnum::DONE:
                break;
            default:
                throw new InvalidKkoException($subType . " is not supported");
        }
    }
}
