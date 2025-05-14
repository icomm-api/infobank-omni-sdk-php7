<?php

namespace Infobank\Send\Kko\AlimTalk;

use Infobank\Core\Exceptions\InvalidKkoException;

class AlimTalkMessageType extends AlimTalkMessageTypeEnum
{
    public static function validMsgType($msgType) {
        switch ($msgType) {
            case AlimTalkMessageTypeEnum::AI:
            case AlimTalkMessageTypeEnum::AT:
                break;
            default:
                throw new InvalidKkoException($msgType . " is not supported");
        }
    }
}