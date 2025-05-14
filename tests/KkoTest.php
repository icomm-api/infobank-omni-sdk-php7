<?php

use PHPUnit\Framework\TestCase;
use Infobank\InfobankClient;
use Infobank\Send\Kko\AlimTalk\AlimTalkMessage;
use Infobank\Send\Kko\FriendTalk\FriendTalkMessage;
use Infobank\Send\Kko\KkoButton;
use Infobank\Send\Kko\KkoFallback;

class KkoTest extends TestCase
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

    public function make_alimtalk_message(
        $msgType,
        KkoButton $button
    ): AlimTalkMessage
    {
        return (new AlimTalkMessage(
            "senderkey",
            $msgType,
            "01012341234",
            "templateCode",
            "test"
        ))
            ->addButton($button)
            ->setRef("r")
            ->setFallback(
                (new KkoFallback(
                    "MMS",
                    "0316281500",
                    "text",
                    "title",
                    array(
                        "fileKey"
                    ),
                    "1234"
                ))
            );
    }

    public function test_send_alimtalk_text()
    {
        $client = $this->getInfobankClient();

        $buttons = require __DIR__ . "/sample/makeKkoButtons.php";


        foreach ($buttons as $button){
            $message = $this->make_alimtalk_message(
                "AT",
                $button
            );

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

    public function test_send_alimtalk_image()
    {
        $client = $this->getInfobankClient();

        $buttons = require __DIR__ . "/sample/makeKkoButtons.php";


        foreach ($buttons as $button){
            $message = $this->make_alimtalk_message(
                "AI",
                $button
            );

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

    public function make_friendtalk_message(
        $msgType,
        KkoButton $button
    ): FriendTalkMessage
    {
        return (new FriendTalkMessage(
            "senderKey",
            $msgType,
            "01012341234",
            "text"
        ))
            ->setImgUrl("imagUrl")
            ->addButton($button)
            ->setRef("ref")
            ->setFallback(
                new KkoFallback(
                    "MMS",
                    "0316281500",
                    "text",
                    "title",
                    array(
                        "filekey1"
                    )
                )
            );
    }

    public function test_friendtalk_text(){
        $client = $this->getInfobankClient();

        $buttons = require __DIR__ . "/sample/makeKkoButtons.php";


        foreach ($buttons as $button){
            $message = $this->make_friendtalk_message(
                "FT",
                $button
            );

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

    public function test_friendtalk_image(){
        $client = $this->getInfobankClient();

        $buttons = require __DIR__ . "/sample/makeKkoButtons.php";


        foreach ($buttons as $button){
            $message = $this->make_friendtalk_message(
                "FI",
                $button
            );

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

    public function test_friendtalk_wiede_image(){
        $client = $this->getInfobankClient();

        $buttons = require __DIR__ . "/sample/makeKkoButtons.php";


        foreach ($buttons as $button){
            $message = $this->make_friendtalk_message(
                "FW",
                $button
            );

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
}