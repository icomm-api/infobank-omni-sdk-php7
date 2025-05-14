<?php

use Infobank\InfobankClient;
use Infobank\Send\Sms\SmsMessage;
use PHPUnit\Framework\TestCase;

class SmsTest extends TestCase
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

    public function testSendSMS()
    {
        $client = $this->getInfobankClient();

        $message = (new SMSMessage(
            "0316281500",
            "01012341234",
            "test"
        ))
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