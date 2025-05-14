<?php

require 'vendor/autoload.php';

use Infobank\InfobankClient;
use \Infobank\Send\Kko\AlimTalk\AlimTalkMessage;
use \Infobank\Send\Kko\FriendTalk\FriendTalkMessage;
use \Infobank\Send\Kko\KkoButton;
use \Infobank\Send\Kko\KkoFallback;

$baseUrl = "https://omni.ibapi.kr/";
$token = "{token}";
$clientId = "{clientId}";
$password = "{password}";

$client = new InfobankClient($baseUrl, $token, $clientId, $password);

// 1. 알림톡 발송

// 1.1. AT 타입 발송
$msg = new AlimTalkMessage("senderKey","AT","01012341234","AT_templateCode","text");
// 옵션 필드 입력
$msg
    ->setRef("php7 sdk AlimTalk AT")
    ->addButton(
        (new KkoButton("button1"))->makeAcButton()
    )
    ->addButton(
        (new KkoButton('button2'))->makeAlButton("phoneNumber",null,null,null)
    )
    ->setFallback(
        (new KkoFallback("SMS","0316281500","text"))
            ->setOriginCID("1234")
    )
;

$apiResponse = $client->sendMessage($msg);
// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";

echo "\n=====================================\n";



// 1.2. AI 타입 발송
$msg = new AlimTalkMessage("senderKey","AI","01012341234","AI_templateCode","text");
// 옵션 필드 입력
$msg
    ->setRef("php7 sdk AlimTalk AI")
    ->addButton(
        (new KkoButton("button1"))->makeAcButton()
    )
    ->addButton(
        (new KkoButton('button2'))->makeAlButton("phoneNumber",null,null,null)
    )
    ->setFallback(
        (new KkoFallback("MMS","0316281500","text"))
            ->setTitle("title")
            ->setFileKey(array("fileKey"))
            ->setOriginCID("1234")
    )
;

$apiResponse = $client->sendMessage($msg);
// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";

echo "\n=====================================\n";


// 2. 친구톡 발송

// 2.1 FT 타입 발송
$msg = new FriendTalkMessage("senderKey","FT","01012341234","text");
// 옵션 필드 입력
$msg
    ->setRef("php7 sdk FriendTalk FT")
    ->addButton(
        (new KkoButton("button1"))->makeAcButton()
    )
    ->addButton(
        (new KkoButton('button2'))->makeAlButton("phoneNumber",null,null,null)
    )
    ->setFallback(
        (new KkoFallback("SMS","0316281500","text"))
            ->setOriginCID("1234")
    )
;

$apiResponse = $client->sendMessage($msg);
// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";

echo "\n=====================================\n";


// 2.2 FI 타입 발송
$msg = new FriendTalkMessage("senderKey","FI","01012341234","text");
// 옵션 필드 입력
$msg
    ->setImgUrl("imgUrl")
    ->setRef("php7 sdk FriendTalk FI")
    ->addButton(
        (new KkoButton("button1"))->makeAcButton()
    )
    ->addButton(
        (new KkoButton('button2'))->makeAlButton("phoneNumber",null,null,null)
    )
    ->setFallback(
        (new KkoFallback("MMS","0316281500","text"))
            ->setTitle("title")
            ->setFileKey(array("fileKey"))
            ->setOriginCID("1234")
    )
;

$apiResponse = $client->sendMessage($msg);
// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";

echo "\n=====================================\n";


// 2.3 FW 타입 발송
$msg = new FriendTalkMessage("senderKey","FW","01012341234","text");
// 옵션 필드 입력
$msg
    ->setImgUrl("imgUrl")
    ->setRef("php7 sdk FriendTalk FW")
    ->addButton(
        (new KkoButton("button1"))->makeAcButton()
    )
    ->addButton(
        (new KkoButton('button2'))->makeAlButton("phoneNumber",null,null,null)
    )
    ->setFallback(
        (new KkoFallback("MMS","0316281500","text"))
            ->setTitle("title")
            ->setFileKey(array("fileKey"))
            ->setOriginCID("1234")
    )
;

$apiResponse = $client->sendMessage($msg);
// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";

echo "\n=====================================\n";


