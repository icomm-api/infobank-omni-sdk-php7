<?php

namespace Infobank\Regist\ImgFile;

use Infobank\Core\Exceptions\InvalidImageServiceType;

class ImageServiceType extends ImageServiceTypeEnum
{

    public static function validServiceType($serviceType)
    {
        switch($serviceType){
            case ImageServiceTypeEnum::MMS:
            case ImageServiceTypeEnum::RCS:
            case ImageServiceTypeEnum::FRIENDTALK:
            case ImageServiceTypeEnum::BRANDMESSAGE:

                break;
            default:
                throw new InvalidImageServiceType($serviceType . "is not supported");
        }
    }
}