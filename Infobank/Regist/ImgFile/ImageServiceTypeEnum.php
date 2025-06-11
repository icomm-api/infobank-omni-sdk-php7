<?php

namespace Infobank\Regist\ImgFile;

abstract class ImageServiceTypeEnum
{
    const MMS = "MMS";
    const RCS = "RCS";
    const FRIENDTALK = "FRIENDTALK";
    const BRANDMESSAGE = "BRANDMESSAGE";

    abstract static function validServiceType(ImageServiceTypeEnum $serviceType);
}