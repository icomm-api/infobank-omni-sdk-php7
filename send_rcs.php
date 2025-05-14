<?php

require 'vendor/autoload.php';

use Infobank\InfobankClient;
use Infobank\Send\Rcs\RcsButton;
use Infobank\Send\Rcs\RcsCarousel;
use Infobank\Send\Rcs\RcsContent;
use Infobank\Send\Rcs\RCSFallback;
use Infobank\Send\Rcs\RcsMessage;
use Infobank\Send\Rcs\RcsStandAlone;
use Infobank\Send\Rcs\RcsSubContent;
use Infobank\Send\Rcs\RcsTemplate;

$baseUrl = "https://omni.ibapi.kr/";
$token = "{token}";
$clientId = "{clientId}";
$password = "{password}";

$client = new InfobankClient($baseUrl, $token, $clientId, $password);

// 1. RCS StandAlone 발송
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

$msg = new RcsMessage($content,"0316281500","01012341234","formatId","brandKey");
$msg
    ->setBrandId("brandId")
    ->setExpiryOption("1")
    ->setHeader("1")
    ->setFooter("footer")
    ->setRef("php7 sdk RCS StandAlone");

$apiResponse = $client->sendMessage($msg);
// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";
echo "\n=====================================\n";


// 2. RCS Carousel 발송
$carousel = (new RcsCarousel())
    ->setTitle("title")
    ->setText("rcs Carousel text")
    ->setMedia("media")
    ->setMediaUrl("mediaUrl")
    ->addButton((new RcsButton("basic button"))->makeUrlButton("https://naver.com"))
;

$content = (new RcsContent())->setCarousel(array($carousel, $carousel, $carousel));

$msg = new RcsMessage($content,"0316281500","01012341234","formatId","brandKey");
$msg
    ->setBrandId("brandId")
    ->setExpiryOption("1")
    ->setHeader("1")
    ->setFooter("footer")
    ->setRef("php7 sdk RCS Carousel");

$apiResponse = $client->sendMessage($msg);
// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";
echo "\n=====================================\n";



// 3. RCS Template 발송
$template = (new RcsTemplate())
    ->setDescription("description")
    ->add("key1", "value1")
    ->add("key2", "value2")
    ->setSubContent(array(
        new RcsSubContent(
            "subTitle",
            "subDesc",
            "subMedia",
            "subMediaUrl"
        )
    ));

$content = (new RcsContent())->setTemplate($template);

$msg = new RcsMessage($content,"0316281500","01012341234","formatId","brandKey");
$msg
    ->setBrandId("brandId")
    ->setExpiryOption("1")
    ->setHeader("1")
    ->setFooter("footer")
    ->setRef("php7 sdk RCS Template");

$apiResponse = $client->sendMessage($msg);
// 응답 출력
echo "httpCode : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "msgKey : " . $apiResponse->getMsgKey() . "\r\n";
echo "ref : " . $apiResponse->getRef() . "\r\n";
echo "\n=====================================\n";
