<?php

namespace Infobank\Send\Kko;

abstract class KkoMsgTypeEnum
{

    const AT = "AT";
    const AI = "AI";
    const FT = "FT";
    const FI = "FI";
    const FW = "FW";
    const FL = "FL";
    const FC = "FC";
    const FP = "FP";
    const FM = "FM";
    const FA = "FA";
    const DEFAULT = "default";
    const WIDE = "wide";
    const WIDE_ITEM_LIST = "wideItemList";
    const CAROUSEL_FEED = "carouselFeed ";
    const CAROUSEL_COMMERCE = "carouselCommerce";


    abstract static function validMsgType(KkoMsgTypeEnum $msgType);
}