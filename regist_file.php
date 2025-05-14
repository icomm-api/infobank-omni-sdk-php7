<?php

require 'vendor/autoload.php';

use Infobank\InfobankClient;
use Infobank\Regist\ImgFile\ImageFile;
use Infobank\Regist\ImgFile\ImageServiceTypeEnum;

$baseUrl = "https://omni.ibapi.kr/";
$token = "{token}";
$clientId = "{clientId}";
$password = "{password}";

$client = new InfobankClient($baseUrl, $token, $clientId, $password);

$fileName = "E:/Workspace/OmniSdk/OmniSdkPhp7/image.jpg";

$img = (new ImageFile(ImageServiceTypeEnum::RCS))
    ->setFileName($fileName);

$apiResponse = $client->registImgFile($img);

// 응답 출력
echo "ApiResponse: ".json_encode($apiResponse)."\n";

//$data = array_merge_recursive(
//    [
//        RequestOptions::HEADERS => [
//            'Accept' => 'application/json',
//            'Content-Type' => 'application/json',
//            'Authorization' => 'token'
//        ],
//    ],
//    [
//        RequestOptions::BODY =>[
//            'file' => file_get_contents($fileName)
//        ],
//    ]
//);
//echo "req data: ".json_encode($data)."\n";

//$imageBinary = file_get_contents($fileName);
//
//// 변환된 바이너리 데이터 출력
//echo base64_encode($imageBinary);

