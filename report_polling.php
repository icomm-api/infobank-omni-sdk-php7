<?php

require 'vendor/autoload.php';

use Infobank\InfobankClient;

$baseUrl = "https://omni.ibapi.kr/";
$token = "{token}";
$clientId = "{clientId}";
$password = "{password}";

$client = new InfobankClient($baseUrl, $token, $clientId, $password);

$apiResponse = $client->reportPollingGet();

echo "status_code : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "reportId : " . $apiResponse->getData()->getReportId() . "\r\n";

foreach($apiResponse->getData()->getReport() as $report ){
//    echo "msgKey:".$report->getMsgKey()." serviceType:".$report->getServiceType()." msgType:".$report->getMsgType()
//        ." reportType:".$report->getReportType()." reportCode:".$report->getReportCode()." reportTime:".$report->getReportTime()
//        ." carrier:".$report->getCarrier()." resCnt:".$report->getResCnt()." ref:".$report->getRef() . "\r\n";
    echo json_encode($report). "\r\n";
}

$response = $client->reportPollingDel(
    $apiResponse->getData()->getReportId()
);

echo "status_code : " . $response->getHttpCode() . "\r\n";
echo "code : " . $response->getCode() . "\r\n";
echo "result : " . $response->getResult() . "\r\n";

