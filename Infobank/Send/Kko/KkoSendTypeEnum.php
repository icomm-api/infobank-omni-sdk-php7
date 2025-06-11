<?php

namespace Infobank\Send\Kko;

abstract class KkoSendTypeEnum
{

    const BASIC = "basic";
    const FREE = "free";
    
    abstract static function validSendType(KkoSendTypeEnum $msgType);
}