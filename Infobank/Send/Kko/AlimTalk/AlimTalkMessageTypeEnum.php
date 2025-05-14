<?php

namespace Infobank\Send\Kko\AlimTalk;

abstract class AlimTalkMessageTypeEnum{
    const AT = "AT";
    const AI = "AI";

    abstract static function validMsgType(AlimTalkMessageTypeEnum $msgType);
}