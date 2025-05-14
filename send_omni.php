<?php

require 'vendor/autoload.php';

use Infobank\InfobankClient;
use \Infobank\Send\Omni\AlimTalk\AlimTalkMessage;
use \Infobank\Send\Kko\FriendTalk\FriendTalkMessage;
use \Infobank\Send\Kko\KkoButton;
use \Infobank\Send\Kko\KkoFallback;
use Infobank\Send\Omni\OmniMessage;

$baseUrl = "https://omni.ibapi.kr/";
$token = "{token}";
$clientId = "{clientId}";
$password = "{password}";

$client = new InfobankClient($baseUrl, $token, $clientId, $password);


// 1. 알림톡 발송

// 1.1. AT 타입 발송
//$replaceWords = '{"uuid":"testUuid","orderUser":"\ud14c\uc2a4\ud2b8","orderSeq":"111222333"}';
$replaceWords = [
    "uuid"=>"testUuid",
    "orderUser"=>"\ud14c\uc2a4\ud2b8",
    "orderSeq"=>"111222333"
];
$message = new OmniMessage(
    array(new \Infobank\Send\Omni\Destinations("01012341234",$replaceWords))
);
$atMsg = new AlimTalkMessage("senderKey", "AT","templateCode", "text");
$attachment = new \Infobank\Send\Omni\Alimtalk\Attachment();
$attachment->addButton(
    (new KkoButton("구매후기 작성하기"))
        ->makeWlButton("https://naver.com","https://naver.com")
);
$atMsg->setAttachment($attachment);
$message->addMessageFlow(new \Infobank\Send\Omni\MessageFlow($atMsg));

// 발송 전문 출력
echo "\n=====================================\n";
echo "message : " .$message . "\r\n";
echo "\n=====================================\n";

$apiResponse = $client->sendMessage($message);

// 응답 출력
echo "\n=====================================\n";
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";
echo "\n=====================================\n";


