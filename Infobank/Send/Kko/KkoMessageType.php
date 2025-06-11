<?php

namespace Infobank\Send\Kko;

use Infobank\Core\Exceptions\InvalidKkoException;

class KkoMessageType
{
    public static function validMsgType($msgType){
        switch($msgType){
            case KkoMessageTypeEnum::AI:
            case KkoMessageTypeEnum::AT:
            case KkoMessageTypeEnum::FI:
            case KkoMessageTypeEnum::FT:
            case KkoMessageTypeEnum::FW:
            case KkoMessageTypeEnum::FL:
            case KkoMessageTypeEnum::FC:
            case KkoMessageTypeEnum::FP:
            case KkoMessageTypeEnum::FM:
            case KkoMessageTypeEnum::FA:
            case KkoMessageTypeEnum::DEFAULT:
            case KkoMessageTypeEnum::WIDE:
            case KkoMessageTypeEnum::WIDE_ITEM_LIST:
            case KkoMessageTypeEnum::CAROUSEL_FEED:
            case KkoMessageTypeEnum::CAROUSEL_COMMERCE:
                break;
            default:
                throw new InvalidKkoException($msgType . " is not supported");
        }
    }
}
