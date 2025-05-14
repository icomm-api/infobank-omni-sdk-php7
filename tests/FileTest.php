<?php

use Infobank\Regist\ImgFile\ImageFile;
use Infobank\Regist\ImgFile\ImageServiceTypeEnum;
use PHPUnit\Framework\TestCase;
use Infobank\InfobankClient;

class FileTest extends TestCase
{

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

    public function testUploadFile()
    {
        $client = $this->getInfobankClient();

        $fileName = "E:/Workspace/OmniSdk/OmniSdkPhp7/image.jpg";

        $message = (new ImageFile(ImageServiceTypeEnum::RCS))
            ->setFileName($fileName);

        $response = $client->registImgFile($message);

        if($response!=null){
            $this->assertEquals(
                $response->getHttpCode(),
                "200",
                "Failed.\nresponse:" . json_encode($response, true) . "\nrequest:" . json_encode($message)
            );

            $this->assertEquals(
                $response->getCode(),
                "A000",
                "Failed.\nresponse:" . json_encode($response, true) . "\nrequest:" . json_encode($message)
            );
        }else{
            echo "response: ".$response;
        }
    }

}