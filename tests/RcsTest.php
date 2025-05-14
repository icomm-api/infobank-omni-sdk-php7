<?php

use Infobank\InfobankClient;
use Infobank\Send\Rcs\RcsCarousel;
use Infobank\Send\Rcs\RcsContent;
use Infobank\Send\Rcs\RCSFallback;
use Infobank\Send\Rcs\RcsMessage;
use Infobank\Send\Rcs\RcsStandAlone;
use Infobank\Send\Rcs\RcsSubContent;
use Infobank\Send\Rcs\RcsTemplate;
use PHPUnit\Framework\TestCase;

class RcsTest extends TestCase
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

    public function make_rcs_standalone($button = null){
        $standalone = (new RcsStandAlone())
            ->setTitle("title")
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
            );

        if ($button != null){
            $standalone->setButton(array(
                $button
            ));
        }
        return (new RcsContent())->setStandalone($standalone);
    }

    public function make_rcs_carousel($button = null){
        $calousel = (new RcsCarousel())
            ->setTitle("title")
            ->setText("text")
            ->setMedia("media")
            ->setMediaUrl("mediaUrl")
            ->setButton(array(
                $button
            ))
        ;
        return (new RcsContent())->setCarousel(array(
            $calousel,
            $calousel,
            $calousel
        ));
    }

    public function make_rcs_template(){
        $template = (new RcsTemplate())
            ->setDescription("description")
            ->setSubContent(array(
                new RcsSubContent(
                    "subTitle",
                    "subDesc",
                    "subMedia",
                    "subMediaUrl"
                )
            ));
        return (new RcsContent())->setTemplate($template);
    }

    public function make_rcs_cell(){
        $template = (new RcsTemplate())
            ->add("value1", "value1")
            ->add("value2", "value2")
            ->setSubContent(array(
                new RcsSubContent(
                    "subTitle",
                    "subDesc",
                    "subMedia",
                    "subMediaUrl"
                )
            ));
        return (new RcsContent())->setTemplate($template);
    }

    public function make_rcs_message($content){
        $fallback  = (new RCSFallback(
            "MMS",
            "text",
            "title"
        ));

        return (new RcsMessage(
            $content,
            "0316281500",
            "01012341234",
            "formatId",
            "brandKey"
        ))
            ->setBrandId("brandId")
            ->setExpiryOption("1")
            ->setHeader("1")
            ->setFooter("footer")
            ->setRef("ref")
            ->setFallback($fallback);
    }


    public function test_rcs_standalone() {

        $buttons = require __DIR__ . "/sample/makeRcsButtons.php";
        $infobankClient = $this->getInfobankClient();

        foreach ($buttons as $button){
            $message = $this->make_rcs_message(
                $this->make_rcs_standalone($button)
            );

            $response = $infobankClient->sendMessage($message);

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

    public function test_rcs_carousel() {

        $buttons = require __DIR__ . "/sample/makeRcsButtons.php";
        $client = $this->getInfobankClient();

        foreach ($buttons as $button){
            $message = $this->make_rcs_message(
                $this->make_rcs_carousel($button)
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

    public function test_rcs_template() {

        $client = $this->getInfobankClient();

        $message = $this->make_rcs_message(
            $this->make_rcs_template()
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

    public function test_rcs_cell() {

        $client = $this->getInfobankClient();

        $message = $this->make_rcs_message(
            $this->make_rcs_cell()
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