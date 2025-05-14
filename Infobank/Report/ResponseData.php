<?php

namespace Infobank\Report;

class ResponseData implements \JsonSerializable
{
    private $reportId;
    private $report;

    public function __construct($reportId, $report)
    {
        $this->reportId = $reportId;
        $this->report = $report;
    }

    public function getReportId(): string
    {
        return $this->reportId;
    }

    public function getReport(): array
    {
        $report = [];
        foreach ($this->report as $data) {
            $report[] = new Report(
                isset($data['msgKey']) ? $data['msgKey'] : "",
                isset($data['serviceType']) ? $data['serviceType'] : "",
                isset($data['msgType']) ? $data['msgType'] : "",
                isset($data['reportType']) ? $data['reportType'] : "",
                isset($data['reportCode']) ? $data['reportCode'] : "",
                isset($data['reportTime']) ? $data['reportTime'] : "",
                isset($data['carrier']) ? $data['carrier'] : "",
                isset($data['resCnt']) ? $data['resCnt'] : "",
                isset($data['ref']) ? $data['ref'] : ""
            );
        }
        return $report;
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