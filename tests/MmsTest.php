<?php

use Infobank\InfobankClient;
use Infobank\Send\Mms\MmsMessage;
use PHPUnit\Framework\TestCase;

class MmsTest extends TestCase
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

    public function testSendMMS()
    {
        $client = $this->getInfobankClient();

        $message = (new MMSMessage(
            "0316281500",
            "01012341234",
            "test"
        ))
            ->setFileKey(array("fileKey1"))
            ->setTitle("title")
            ->setRef("ref")
            ->setOriginCID("originCID");

        $response = $client->sendMessage($message);

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

        $this->assertEquals(
            $message->getRef(),
            $response->getRef()
        );

        $this->assertNotEmpty(
            $response->getMsgKey()
        );
    }
}