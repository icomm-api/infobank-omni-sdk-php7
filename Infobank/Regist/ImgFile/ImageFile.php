<?php

declare(strict_types=1);

namespace Infobank\Regist\ImgFile;

use Infobank\Send\Kko\KkoMessageType;

class ImageFile implements \JsonSerializable
{
    private $serviceType;
    private $msgType;
    private $subType;
    private $fileName;

    /**
     * @param string $serviceType 이미지가 사용 될 서비스 타입(MMS, RCS, FRIENDTALK, BRANDMESSAGE)
     */
    public function __construct(
        string $serviceType
    ){
        ImageServiceType::validServiceType($serviceType);
        $this->serviceType = $serviceType;
    }

    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    public function getMsgType(): string
    {
        return $this->msgType;
    }

    public function setMsgType(string $msgType): KkoMessageType
    {
        $this->msgType = $msgType;
        return $this;
    }

    public function getSubType(): string
    {
        return $this->subType;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): ImageFile
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function jsonSerialize(): array
    {
        $vars = get_object_vars($this);
        $filteredVars = [];

        foreach ($vars as $key => $value) {
            if ($value !== null) {
                $filteredVars[$key] = $value;
            }
        }

        return $filteredVars;
    }
}