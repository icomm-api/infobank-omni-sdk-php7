<?php

namespace Infobank\Send\Kko\FriendTalk;

use Infobank\Core\Exceptions\InvalidKkoException;

class FriendTalkMessageType
{
    public static function validMsgType($msgType){
        switch($msgType){
            case FriendTalkMessageTypeEnum::FI:
            case FriendTalkMessageTypeEnum::FT:
            case FriendTalkMessageTypeEnum::FW:
                break;
            default:
                throw new InvalidKkoException($msgType . " is not supported");
        }
    }
}