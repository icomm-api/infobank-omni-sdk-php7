<?php

namespace Infobank\Regist\ImgFile;

abstract class ImageServiceTypeEnum
{
    const MMS = "MMS";
    const RCS = "RCS";

    abstract static function validServiceType(ImageServiceTypeEnum $serviceType);
}