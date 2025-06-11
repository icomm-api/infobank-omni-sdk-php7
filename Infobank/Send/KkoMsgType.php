<?php

namespace Infobank\Send\Kko;

use Infobank\Core\Exceptions\InvalidKkoException;

class KkoMsgType
{
    public static function validMsgType($msgType){
        switch($msgType){
            case KkoMsgTypeEnum::AI:
            case KkoMsgTypeEnum::AT:
            case KkoMsgTypeEnum::FI:
            case KkoMsgTypeEnum::FT:
            case KkoMsgTypeEnum::FW:
            case KkoMsgTypeEnum::FL:
            case KkoMsgTypeEnum::FC:
            case KkoMsgTypeEnum::FP:
            case KkoMsgTypeEnum::FM:
            case KkoMsgTypeEnum::FA:
            case KkoMsgTypeEnum::DEFAULT:
            case KkoMsgTypeEnum::WIDE:
            case KkoMsgTypeEnum::WIDE_ITEM_LIST:
            case KkoMsgTypeEnum::CAROUSEL_FEED:
            case KkoMsgTypeEnum::CAROUSEL_COMMERCE:
                break;
            default:
                throw new InvalidKkoException($msgType . " is not supported");
        }
    }
}
