<?php

namespace Infobank\Send\Kko;

abstract class KkoSubTypeEnum
{

    const FIRST = "first";
    const MIDDLE= "middle";
    const DONE = "done";

    abstract static function validSubType(KkoSubTypeEnum $msgType);
}