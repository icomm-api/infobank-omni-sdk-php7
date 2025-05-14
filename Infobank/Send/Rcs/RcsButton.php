<?php

declare(strict_types=1);

namespace Infobank\Send\Rcs;

class RcsButton implements \JsonSerializable
{
    private $type;
    private $name;
    private $url;
    private $label;
    private $latitude;
    private $longitude;
    private $fallbackUrl;
    private $query;
    private $startTime;
    private $endTime;
    private $title;
    private $description;
    private $text;
    private $phoneNumber;

    /**
     * @param string $name 버튼 명
     */
    public function __construct(string $name){
        $this->name = $name;
    }

    /**
     * URL 연결
     *
     * Web page 또는 App으로 이동할 수 있습니다.
     *
     * @param string $url 웹브라우저로 연결할 URL주소
     * @return $this
     */
    public function makeUrlButton(
        string $url
    ): RcsButton
    {
        $this->type = RcsButtonType::URL;
        $this->url = $url;

        return $this;
    }

    /**
     * 지도 보여주기
     *
     * 지정된 좌표로 설정된 지도 App을 실행합니다.
     *
     * @param string $latitude 위도 값
     * @param string $longitude 경도 값
     * @param string|null $label 지도 App에 표시될 라벨명
     * @param string|null $fallbackUrl 지도 App동작이 안 될 경우 대처할 URL
     * @return $this
     */
    public function makeMapLocButton(
        string $latitude,
        string $longitude,
        string $label = null,
        string $fallbackUrl = null
    ): RcsButton
    {
        $this->type = RcsButtonType::MAP_LOC;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->label = $label;
        $this->fallbackUrl = $fallbackUrl;

        return $this;
    }

    /**
     * 지도 검색
     *
     * 검색어를 통해 조회된 지도 App을 실행합니다.
     *
     * @param string $query 지도 App에서 검색할 구문
     * @param string|null $fallbackUrl 지도 App동작이 안 될 경우 대처할 URL
     * @return $this
     */
    public function makeMapQryButton(
        string $query,
        string $fallbackUrl = null
    ): RcsButton
    {
        $this->type = RcsButtonType::MAP_QRY;
        $this->query = $query;
        $this->fallbackUrl = $fallbackUrl;

        return $this;
    }

    /**
     * 위치 전송
     *
     * 휴대폰의 현재 위치 정보를 전송합니다.
     *
     * @return $this
     */
    public function makeMapSendButton(

    ): RcsButton
    {
        $this->type = RcsButtonType::MAP_SEND;

        return $this;
    }

    /**
     * 일정 등록
     *
     * 정해진 일자와 내용으로 일정을 등록합니다.
     *
     * @param string|null $startTime 시작 일정(yyyy-MM-dd’T’HH:mm:ssXXX)
     * @param string|null $endTime 종료 일정(yyyy-MM-dd’T’HH:mm:ssXXX)
     * @param string|null $title
     * @param string|null $description
     * @return $this
     */
    public function makeCalendarButton(
        string $startTime = null,
        string $endTime = null,
        string $title = null,
        string $description = null
    ): RcsButton
    {
        $this->type = RcsButtonType::CALENDAR;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->title = $title;
        $this->description = $description;

        return $this;
    }

    /**
     * 복사하기
     *
     * 지정된 내용을 클립보드로 복사합니다.
     *
     * @param string $text 클립보드로 복사될 내용
     * @return $this
     */
    public function makeCopyButton(
        string $text
    ): RcsButton
    {
        $this->type = RcsButtonType::COPY;
        $this->text = $text;

        return $this;
    }

    /**
     * 대화방 열기 (문자)
     *
     * 메시지 App을 실행합니다.
     *
     * @param string $phoneNumber 대화방의 수신자 번호
     * @param string|null $text 내용
     * @return $this
     */
    public function makeComTButton(
        string $phoneNumber,
        string $text = null
    ): RcsButton
    {
        $this->type = RcsButtonType::COM_T;
        $this->phoneNumber = $phoneNumber;
        $this->text = $text;

        return $this;
    }

    /**
     * 대화방 열기 (음성, 영상)
     *
     * 메시지 App을 실행합니다.
     *
     * @param string $phoneNumber 대화방의 수신자 번호
     * @return $this
     */
    public function makeComVButton(
        string $phoneNumber
    ): RcsButton
    {
        $this->type = RcsButtonType::COM_V;
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * 전화 연결
     *
     * 특정 전화번호로 전화를 걸 수 있습니다.
     *
     * @param string $phoneNumber 대화방의 수신자 번호
     * @return $this
     */
    public function makeDialButton(
        string $phoneNumber
    ): RcsButton
    {
        $this->type = RcsButtonType::DIAL;
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
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