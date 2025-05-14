<?php

namespace Infobank\Report;

class Report implements \JsonSerializable
{
    private $msgKey;
    private $serviceType;
    private $msgType;
    private $reportType;
    private $reportCode;
    private $reportTime;
    private $carrier;
    private $resCnt;
    private $ref;

    public function __construct(
        $msgKey,
        $serviceType = null,
        $msgType = null,
        $reportType = null,
        $reportCode = null,
        $reportTime = null,
        $carrier = null,
        $resCnt = null,
        $ref = null
    ){
        $this->msgKey = $msgKey;
        $this->serviceType = $serviceType;
        $this->msgType = $msgType;
        $this->reportType = $reportType;
        $this->reportCode = $reportCode;
        $this->reportTime = $reportTime;
        $this->carrier = $carrier;
        $this->resCnt = $resCnt;
        $this->ref = $ref;
    }

    /**
     * @return string 메시지 키
     */
    public function getMsgKey(): string
    {
        return $this->msgKey;
    }

    /**
     * @return string 서비스 타입
     */
    public function getServiceType(): ?string
    {
        return $this->serviceType;
    }

    /**
     * @return string 메시지 타입
     */
    public function getMsgType(): ?string
    {
        return $this->msgType;
    }

    /**
     * @return string 리포트 종류
     */
    public function getReportType(): ?string
    {
        return $this->reportType;
    }

    /**
     * @return string 리포트 코드
     */
    public function getReportCode(): ?string
    {
        return $this->reportCode;
    }

    /**
     * @return string 리포트 일시(ISO 8601, yyyy-MM-dd'T'HH:mm:ssXXX)
     */
    public function getReportTime(): ?string
    {
        return $this->reportTime;
    }

    /**
     * @return string 이통사 코드
     */
    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    /**
     * @return string 국제메시지 분할 수
     */
    public function getResCnt(): ?string
    {
        return $this->resCnt;
    }

    /**
     * @return string 참조 필드
     */
    public function getRef(): ?string
    {
        return $this->ref;
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