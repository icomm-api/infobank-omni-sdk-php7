<?php

namespace Infobank\Send\Omni;

use Infobank\Send\Kko\KkoMessageType;
use Infobank\Send\Omni\Kko\Attachment;
use Infobank\Send\Omni\Kko\Carousel;

class FriendtalkMessage implements \JsonSerializable
{
    private $senderKey;
    private $msgType;
    private $text;
    private $attachment;
    private $adFlag;
    private $additionalContent;
    private $adult;
    private $header;
    private $carousel;
    private $groupTagKey;
    private $pushAlarm;
    private $supplement;
    private $price;
    private $currencyType;

    /**
     * @param string $senderKey 카카오 비즈메시지 발신 프로필 키
     * @param string $msgType 카카오 알림톡 메시지 타입
     * @param string $text 친구톡 내용
     */
    public function __construct(string $senderKey, string $msgType, string $text = '')
    {
        KkoMessageType::validMsgType($msgType);
        $this->senderKey = $senderKey;
        $this->msgType = $msgType;
        $this->text = $text;
    }

    public function getSenderKey(): string
    {
        return $this->senderKey;
    }

    public function getMsgType(): string
    {
        return $this->msgType;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): FriendtalkMessage
    {
        $this->text = $text;
        return $this;
    }

    public function getAttachment(): ?Attachment
    {
        return $this->attachment;
    }

    public function setAttachment(Attachment $attachment): FriendtalkMessage
    {
        $this->attachment = $attachment;
        return $this;
    }

    public function getAdFlag(): ?string
    {
        return $this->adFlag;
    }

    public function setAdFlag(string $adFlag): FriendtalkMessage
    {
        $this->adFlag = $adFlag;
        return $this;
    }

    public function getAdditionalContent(): ?string
    {
        return $this->additionalContent;
    }

    public function setAdditionalContent(string $additionalContent): FriendtalkMessage
    {
        $this->additionalContent = $additionalContent;
        return $this;
    }

    public function getAdult(): ?string
    {
        return $this->adult;
    }

    public function setAdult(string $adult): FriendtalkMessage
    {
        $this->adult = $adult;
        return $this;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(string $header): FriendtalkMessage
    {
        $this->header = $header;
        return $this;
    }

    public function getCarousel(): ?Carousel
    {
        return $this->carousel;
    }

    public function setCarousel(Carousel $carousel): FriendtalkMessage
    {
        $this->carousel = $carousel;
        return $this;
    }

    public function getGroupTagKey(): ?string
    {
        return $this->groupTagKey;
    }

    public function setGroupTagKey(string $groupTagKey): FriendtalkMessage
    {
        $this->groupTagKey = $groupTagKey;
        return $this;
    }

    public function getPushAlarm(): ?string
    {
        return $this->pushAlarm;
    }

    public function setPushAlarm(string $pushAlarm): FriendtalkMessage
    {
        $this->pushAlarm = $pushAlarm;
        return $this;
    }

    public function getSupplement(): ?Supplement
    {
        return $this->supplement;
    }

    public function setSupplement(Supplement $supplement): FriendtalkMessage
    {
        $this->supplement = $supplement;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): FriendtalkMessage
    {
        $this->price = $price;
        return $this;
    }

    public function getCurrencyType(): ?string
    {
        return $this->currencyType;
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
