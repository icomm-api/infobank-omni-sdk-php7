<?php

namespace Infobank\Send\Kko;

use Infobank\Core\Exceptions\InvalidKkoException;

class KkoSendType
{
    public static function validSendType($sendType){
        switch($sendType){
            case KkoSendTypeEnum::BASIC:
            case KkoSendTypeEnum::FREE:
                break;
            default:
                throw new InvalidKkoException($sendType . " is not supported");
        }
    }
}
