<?php

namespace Infobank\Send\Kko\FriendTalk;

use Infobank\Send\Kko\KkoButton;
use Infobank\Send\kko\KkoFallback;

class FriendTalkMessage implements \JsonSerializable
{
    private $senderKey;
    private $msgType;
    private $to;
    private $text;

    private $imgUrl;
    private $button;
    private $ref;
    private $fallback;

    /**
     * @param string $senderKey 카카오 비즈메시지 발신 프로필 키
     * @param string $msgType 카카오 알림톡메시지타입
     * @param string $to 수신번호
     * @param string $text 알림톡 내용
     */
    public function __construct(string $senderKey, string $msgType, string $to, string $text)
    {
        FriendTalkMessageType::validMsgType($msgType);

        $this->senderKey = $senderKey;
        $this->msgType = $msgType;
        $this->to = $to;
        $this->text = $text;
    }

    /**
     * @return string 친구톡 이미지 URL
     */
    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    /**
     * @param string 친구톡 이미지 URL
     * @return $this
     */
    public function setImgUrl(
        string $imgUrl
    ): FriendTalkMessage
    {
        $this->imgUrl = $imgUrl;
        return $this;
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
    ): FriendTalkMessage
    {
        foreach ($buttons as $item) {
            if (!$item instanceof KkoButton) {
                throw new InvalidKkoException('Button array must contain instances of RCSButton.');
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
    ): FriendTalkMessage
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
    ): FriendTalkMessage
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * @return KkoButton $fallback 실패 시 전송될 KkoFallback 메시지 정보
     */
    public function getFallback(): KkoButton
    {
        return $this->fallback;
    }

    /**
     * @param KkoFallback $fallback 실패 시 전송될 KkoFallback 메시지 정보
     * @return $this
     */
    public function setFallback(
        KkoFallback $fallback
    ): FriendTalkMessage
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