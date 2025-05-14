<?php

namespace Infobank\Send\Omni\Alimtalk;

use Infobank\Send\Kko\AlimTalk\AlimTalkMessageType;

class AlimTalkMessage implements \JsonSerializable
{
    private $senderKey;
    private $msgType;
    private $templateCode;
    private $text;

    private $title;
    private $attachment;
    private $supplement;
    private $price;
    private $currencyType;

    /**
     * @param string $senderKey 카카오 비즈메시지 발신 프로필 키
     * @param string $msgType 카카오 알림톡메시지타입
     * @param string $templateCode 알림톡 템플릿 코드
     * @param string $text 알림톡 내용
     */
    public function __construct(string $senderKey, string $msgType, string $templateCode, string $text)
    {
        AlimTalkMessageType::validMsgType($msgType);

        $this->senderKey = $senderKey;
        $this->msgType = $msgType;
        $this->templateCode = $templateCode;
        $this->text = $text;
    }

    /**
     * @return string 알림톡 제목(강조표기형 템플릿)
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title 알림톡 제목(강조표기형 템플릿)
     * @return $this
     */
    public function setTitle(string $title): AlimTalkMessage
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return Attachment 첨부 정보
     */
    public function getAttachment(): Attachment
    {
        return $this->attachment;
    }

    /**
     * @param Attachment $attachment 첨부 정보
     * @return $this
     */
    public function setAttachment(Attachment $attachment): AlimTalkMessage
    {
        $this->attachment = $attachment;
        return $this;
    }

    /**
     * @return Supplement 부가 정보
     */
    public function getSupplement(): Supplement
    {
        return $this->supplement;
    }

    /**
     * @param Supplement $supplement 부가 정보
     * @return $this
     */
    public function setSupplement(Supplement $supplement): AlimTalkMessage
    {
        $this->supplement = $supplement;
        return $this;
    }

    /**
     * @return string 메시지 에 포함된 가격/금액/결제금액
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price 메시지 에 포함된 가격/금액/결제금액
     * @return $this
     */
    public function setPrice(string $price): AlimTalkMessage
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string 메시지에 포함된 가격/금액/결제금액의 통화 단위 (국제 통화 코드 - KRW, USD, EUR)
     */
    public function getCurrencyType(): string
    {
        return $this->currencyType;
    }

    /**
     * @param string $currencyType 메시지에 포함된 가격/금액/결제금액의 통화 단위 (국제 통화 코드 - KRW, USD, EUR)
     * @return $this
     */
    public function setCurrencyType(string $currencyType): AlimTalkMessage
    {
        $this->currencyType = $currencyType;
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