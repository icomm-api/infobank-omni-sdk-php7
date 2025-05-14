<?php

require 'vendor/autoload.php';

use Infobank\InfobankClient;
use Infobank\Regist\Form\MessageForm;
use Infobank\Send\Omni\MessageFlow;
use Infobank\Send\Omni\RcsMessage;
use Infobank\Send\Omni\SmsMessage;
use Infobank\Send\Rcs\RcsButton;
use Infobank\Send\Rcs\RcsContent;
use Infobank\Send\Rcs\RcsStandAlone;
use Infobank\Send\Rcs\RcsSubContent;


$baseUrl = "https://omni.ibapi.kr/";
$token = "{token}";
$clientId = "{clientId}";
$password = "{password}";

$client = new InfobankClient($baseUrl, $token, $clientId, $password);

// rcs 메시지 생성
$standalone = (new RcsStandAlone())
    ->setTitle("title")
    ->setText("rcs standAlone text")
    ->setMedia("media")
    ->setMediaUrl("mediaUrl")
    ->setSubContent(
        array(
            new RcsSubContent(
                "subTitle",
                "subDesc",
                "subMedia",
                "subMediaUrl"
            )
        )
    )
    ->addButton((new RcsButton("basic button"))->makeUrlButton("https://naver.com"))
;

$content = (new RcsContent())->setStandalone($standalone);
$rcs = new RcsMessage($content,"0316281500","formatId","brandKey");
$rcs
    ->setBrandId("brandId")
    ->setGroupId("groupId")
    ->setExpiryOption("1")
    ->setCopyAllowed("0")
    ->setHeader("1")
    ->setFooter("footer")
    ->setAgencyId("agencyId")
    ->setAgencyKey("agencyKey")
    ->setTtl("86400")
;

// sms 메시지 생성
$sms = (new SmsMessage("0316281500","hello sms"))
    ->setTtl("86400")
    ->setOriginCID("1234");


// rcs 발송 -> sms 발송으로 form 생성
$form = new MessageForm(
    array(
        new MessageFlow($rcs),
        new MessageFlow($sms)
    )
);

// 1. 등록
$apiResponse = $client->registForm($form);
echo "status_code : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "formId : " . $apiResponse->getFormData()->getFormId() . "\r\n";
echo "expired : " . $apiResponse->getFormData()->getExpired() . "\r\n";
echo "\n=====================================\n";

// 2. 조회
$formId = $apiResponse->getFormData()->getFormId();
$apiResponse = $client->getForm(
    $formId
);
echo "status_code : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "formId : " . $apiResponse->getFormData()->getFormId() . "\r\n";
echo "expired : " . $apiResponse->getFormData()->getExpired() . "\r\n";
echo "\n=====================================\n";

// 3. 수정
$apiResponse = $client->modifyForm(
    $formId,
    $form
);
echo "status_code : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "formId : " . $apiResponse->getFormData()->getFormId() . "\r\n";
echo "expired : " . $apiResponse->getFormData()->getExpired() . "\r\n";
echo "\n=====================================\n";

// 4. 삭제
/* $apiResponse = $client->deleteForm(
    $formId
);

echo "status_code : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n"; */
