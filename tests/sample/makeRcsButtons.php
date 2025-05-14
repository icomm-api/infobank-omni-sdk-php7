<?php

use Infobank\Send\Rcs\RcsButton;

return [
    "url" => (new RcsButton("name"))->makeUrlButton("url"),
    "map_loc" => (new RcsButton("name"))->makeMapLocButton("latitude", "longitude", "label", "fallbackUrl"),
    "map_qry" => (new RcsButton("name"))->makeMapQryButton("query", "fallbackUrl"),
    "map_send" => (new RcsButton("name"))->makeMapSendButton(),
    "calendar" => (new RcsButton("name"))->makeCalendarButton("startTime", "endTime", "title", "description"),
    "copy" => (new RcsButton("name"))->makeCopyButton("text"),
    "com_t" => (new RcsButton("name"))->makeComTButton("01012341234", "text"),
    "com_v" => (new RcsButton("name"))->makeComVButton("01012341234"),
    "dial" => (new RcsButton("name"))->makeDialButton("01012341234")
];
?>