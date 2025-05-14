<?php

use PHPUnit\Framework\TestCase;
use Infobank\InfobankClient;

class ReportTest extends TestCase
{
    private $reportId;

    public function getInfobankClient(): InfobankClient
    {
        $account = require __DIR__ . "/sample/account.php";
        $infobankClient = new InfobankClient(
            $account['baseUrl'],
            $account['token'],
            $account['clientId'],
            $account['password']);
        return $infobankClient;
    }

    public function test_request_report()
    {
        $client = $this->getInfobankClient();

        $response = $client->reportPollingGet();

        $this->assertEquals(
            $response->getHttpCode(),
            "200",
            "Failed.\nresponse:" . json_encode($response, true)
        );

        $this->assertEquals(
            $response->getCode(),
            "A000",
            "Failed.\nresponse:" . json_encode($response, true)
        );

        $this->assertEquals(
            $response->getResult(),
            "Success",
            "Failed.\nresponse:" . json_encode($response, true)
        );

        foreach($response->getData()->getReport() as $report){
            $this->assertNotEmpty(
                $report->getMsgKey(),
                "Failed.\nresponse:" . json_encode($response, true)
            );
        }

        $this->reportId = strlen($response->getData()->getReportId()) > 0 ? $response->getData()->getReportId() : "";
    }

    public function test_delete_reports()
    {
        $client = $this->getInfobankClient();

        $this->test_request_report();

        $response = $client->reportPollingDel(
            $this->reportId
        );

        if (strlen($this->reportId) > 0 ){
            $this->assertNotEquals(
                $response->getHttpCode(),
                "403",
                "Failed.\nresponse:" . json_encode($response, true)
            );
        }else{
            $this->assertNotEquals(
                $response->getHttpCode(),
                "200",
                "Failed.\nresponse:" . json_encode($response, true)
            );

            $this->assertNotEquals(
                $response->getCode(),
                "A000",
                "Failed.\nresponse:" . json_encode($response, true)
            );
        }
    }
}