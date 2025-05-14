<?php

require 'vendor/autoload.php';

use Infobank\InfobankClient;
use Infobank\Send\Sms\SmsMessage;

$baseUrl = "https://omni.ibapi.kr/";
$token = "{token}";
$clientId = "{clientId}";
$password = "{password}";

$client = new InfobankClient($baseUrl, $token, $clientId, $password);

$client->setSdkDebugLog("", true);

// sms 객체 생성(필수값 입력)
$msg = new SmsMessage("0316281500","01012341234","hello sms");
// 옵션 필드 입력
$msg
    ->setRef("php7 sdk")
    ->setOriginCID("1234");

$apiResponse = $client->sendMessage($msg);

// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";


