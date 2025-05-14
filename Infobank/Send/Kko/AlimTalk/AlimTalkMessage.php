<?php

namespace Infobank\Send\Kko\AlimTalk;

use Infobank\Send\Kko\KkoButton;
use Infobank\Send\Kko\KkoFallback;

class AlimTalkMessage implements \JsonSerializable
{
    private $senderKey;
    private $msgType;
    private $to;
    private $templateCode;
    private $text;

    private $button;
    private $ref;
    private $fallback;

    /**
     * @param string $senderKey 카카오 비즈메시지 발신 프로필 키
     * @param string $msgType 카카오 알림톡메시지타입
     * @param string $to 수신번호
     * @param string $templateCode 알림톡 템플릿 코드
     * @param string $text 알림톡 내용
     */
    public function __construct(string $senderKey, string $msgType, string $to, string $templateCode, string $text)
    {
        AlimTalkMessageType::validMsgType($msgType);

        $this->senderKey = $senderKey;
        $this->msgType = $msgType;
        $this->to = $to;
        $this->templateCode = $templateCode;
        $this->text = $text;
    }

    /**
     * @return array 카카오 버튼 정보(최대 5개)
     */
    public function getButton(): array
    {
        return $this->button;
    }

    /**
     * @param array 카카오 버튼 정보(최대 5개)
     * @return $this
     */
    public function setButton(
        array $buttons
    ): AlimTalkMessage
    {
        foreach ($buttons as $item) {
            if (!$item instanceof KkoButton) {
                throw new InvalidKkoException('Button array must contain instances of KkoButton.');
            }
        }
        $this->button = $buttons;
        return $this;
    }

    /**
     * @param KkoButton $button 카카오 버튼 정보
     * @return $this
     */
    public function addButton(
        KkoButton $button
    ): AlimTalkMessage
    {
        $this->button[] = $button;
        return $this;
    }

    /**
     * @return string 참조필드
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * @param string $ref 참조필드
     * @return $this
     */
    public function setRef(
        string $ref
    ): AlimTalkMessage
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * @return KkoFallback $fallback 실패 시 전송될 KkoFallback 메시지 정보
     */
    public function getFallback(): KkoFallback
    {
        return $this->fallback;
    }

    /**
     * @param KkoFallback $fallback 실패 시 전송될 KkoFallback 메시지 정보
     * @return $this
     */
    public function setFallback(
        KkoFallback $fallback
    ): AlimTalkMessage
    {
        $this->fallback = $fallback;
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