<?php

namespace Infobank\Send\Kko\FriendTalk;

abstract class FriendTalkMessageTypeEnum
{
    const FT = "FT";
    const FI = "FI";
    const FW = "FW";

    abstract static function validMsgType(FriendTalkMessageTypeEnum $msgType);
}