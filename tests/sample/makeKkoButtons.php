<?php

use Infobank\Send\Kko\KkoButton;

return [
    "wl" => (new KkoButton("name"))->makeWlButton("urlPc"),
    "al" => (new KkoButton("name"))->makeAlButton("schemeAndroid", "schemeIos", "urlMobile", "urlPc"),
    "bk" => (new KkoButton("name"))->makeBkButton(),
    "md" => (new KkoButton("name"))->makeMdButton(),
    "ds" => (new KkoButton("name"))->makeDsButton(),
    "bc" => (new KkoButton("name"))->makeBcButton("chatExtra"),
    "bt" => (new KkoButton("name"))->makeBtButton("chatExtra", "chatEvent"),
    "ac" => (new KkoButton("name"))->makeAcButton(),
    "bf" => (new KkoButton("name"))->makeBfButton("bizFormKey", "bizFormId")
];
?>