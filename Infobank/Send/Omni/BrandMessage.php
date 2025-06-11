<?php

namespace Infobank\Send\Omni;

use Infobank\Send\Kko\KkoSendType;
use Infobank\Send\Kko\KkoMessageType;
use Stringable;

class BrandMessage implements \JsonSerializable
{
    private $senderKey;
    private $sendType;
    private $msgType;
    private $text;
    private $carousel;
    private $attachment;
    private $header;
    private $targeting;
    private $templateCode;
    private $groupTagKey;
    private $pushAlarm;
    private $adFlag;
    private $messageVariable;
    private $buttonVariable;
    private $couponVariable;
    private $imageVariable;
    private $videoVariable;
    private $commerceVariable;
    private $carouselVariable;
    private $originCID;
    private $unsubscribePhoneNumber;
    private $unsubscribeAuthNumber;

    /**
     * @param string $senderKey 카카오 비즈메시지 발신 프로필 키
     * @param string $msgType 카카오 알림톡 메시지 타입
     * @param string $text 브랜드메세지 내용
     */
    public function __construct(string $senderKey, string $sendType, string $msgType)
    {
        KkoMessageType::validMsgType($msgType);
        KkoSendType::validMsgType($sendType);
        $this->senderKey = $senderKey;
        $this->sendType = $sendType;
        $this->msgType = $msgType;
    }
    
    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): BrandMessage
    {
        $this->text = $text;
        return $this;
    }

    public function getCarousel(): Carousel
    {
        return $this->carousel;
    }

    public function setCarousel(BrandMessage $carousel): BrandMessage
    {
        $this->carousel = $carousel;
        return $this;
    }

    public function getAttachment() : Attachment
    {
        return $this->attachment;
    }

    public function setAttachment(Attachment $attachment): BrandMessage
    {
        $this->attachment = $attachment;
        return $this;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function setHeader(string $header): BrandMessage
    {
        $this->header = $header;
        return $this;
    }

    public function getTargeting(): string
    {
        return $this->targeting;
    }

    public function setTargeting(string $targeting): BrandMessage
    {
        $this->targeting = $targeting;
        return $this;
    }

    public function getTemplateCode(): string
    {
        return  $this->templateCode;
    }

    public function setTemplateCode(string $templateCode): BrandMessage
    {
        $this->templateCode = $templateCode;
    }

    public function getAdditionContent(): string
    {
        return  $this->additionContent;
    }

    public function setAdditionContent(string $additionContent): BrandMessage
    {
        $this->additionContent = $additionContent;
        return $this;
    }

    public function getGroupTagKey(): string
    {
        return $this->groupTagKey;
    }

    public function setGroupTagKey(string $groupTagKey): BrandMessage
    {
        $this->groupTagKey = $groupTagKey;
        return $this;
    }

    public function getAdult() : string
    {
        return $this->adult;
    }

    public function setAdult(string $adult): BrandMessage
    {   
        $this->adult = $adult;
        return $this;
    }

    public function getPushAlarm(): string
    {
        return $this->pushAlarm;
    }

    public function setPushAlarm(string $pushAlarm): BrandMessage
    {   
        $this->pushAlarm = $pushAlarm;
        return $this;
    }

    public function getAdFlag(): string
    {
        return  $this->adFlag;
    }

    public function setAdFlag(string $adFlag): BrandMessage
    {
        $this->adFlag = $adFlag;
        return $this;
    }

    public function getMessageVariable(): object
    {
        return $this->messageVariable;
    }

    public function setMessageVariable(object $messageVariable): BrandMessage
    {
        $this->messageVariable = $messageVariable;
        return $this;
    }

    public function getButtonVariable() : object
    {
        return $this->buttonVariable;
    }

    public function setButtonVariable(object $buttonVariable): BrandMessage
    {
        $this->buttonVariable = $buttonVariable;
        return $this;
    }

    public function getCouponVariable() : object
    {
        return $this->couponVariable;
    }

    public function setCouponVariable(object $couponVariable): BrandMessage
    {
        $this->couponVariable = $couponVariable;
        return $this;
    }

    public function getImageVariable() : object
    {
        return  $this->imageVariable;
    }

    public function setImageVariable(object $imageVariable): BrandMessage
    {
        $this->imageVariable = $imageVariable;
        return $this;
    }

    public function getVideoVariable() : object
    {
        return $this->videoVariable;
    }

    public function setVideoVariable(object $videoVariable): BrandMessage
    {
        $this->videoVariable = $videoVariable;
        return $this;
    }

    public function getCommerceVariable() : object
    {
        return $this->commerceVariable;
    }

    public function setCommerceVariable(object $commerceVariable): BrandMessage
    {
        $this->commerceVariable = $commerceVariable;
        return $this;
    }

    public function getCarouselVariable() : object
    {
        return $this->carouselVariable;
    }

    public function setCarouselVariable(object $carouselVariable): BrandMessage
    {
        $this->carouselVariable = $carouselVariable;
        return $this;
    }

    public function getOriginCID() : string
    {
        return $this->originCID;
    }

    public function setOriginCID(string $originCID): BrandMessage
    {
        $this->originCID = $originCID;
        return $this;
    }

    public function getUnsubscribePhoneNumber() : string
    {
        return $this->unsubscribePhoneNumber;
    }

    public function setUnsubscribePhoneNumber(string $unsubscribePhoneNumber): BrandMessage
    {
        $this->unsubscribePhoneNumber = $unsubscribePhoneNumber;
        return $this;
    }

    public function getUnsubscribeAuthNumber() : string
    {
        return $this->unsubscribeAuthNumber;
    }

    public function setUnsubscribeAuthNumber(string $unsubscribeAuthNumber): BrandMessage
    {
        $this->unsubscribeAuthNumber = $unsubscribeAuthNumber;
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
