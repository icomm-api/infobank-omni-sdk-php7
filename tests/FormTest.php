<?php

use Infobank\Regist\Form\MessageForm;
use Infobank\Send\Kko\AlimTalk\AlimTalkMessageTypeEnum;
use Infobank\Send\Omni\Alimtalk\Attachment;
use Infobank\Send\Omni\Alimtalk\AttachmentItem;
use Infobank\Send\Omni\Alimtalk\AttachmentItemHighlight;
use Infobank\Send\Omni\Alimtalk\AttachmentItemList;
use Infobank\Send\Omni\Alimtalk\Supplement;
use Infobank\Send\Omni\MessageFlow;
use Infobank\Send\Rcs\RcsCarousel;
use Infobank\Send\Rcs\RcsContent;
use Infobank\Send\Rcs\RcsStandAlone;
use Infobank\Send\Rcs\RcsSubContent;
use Infobank\Send\Rcs\RcsTemplate;
use PHPUnit\Framework\TestCase;
use Infobank\InfobankClient;
use \Infobank\Send\Omni\SmsMessage;
use \Infobank\Send\Omni\MmsMessage;
use \Infobank\Send\Omni\RcsMessage;
use \Infobank\Send\Omni\Alimtalk\AlimTalkMessage;

class FormTest extends TestCase
{
    private $formId;

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

    public function check_assert(
        $response,
        $message
    ){
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
            $response->getResult(),
            "Success",
            "Failed.\nresponse:" . json_encode($response, true) . "\nrequest:" . json_encode($message)
        );

        $this->formId = $response->getFormData()->getFormId();
    }

    public function make_sms_message(): SmsMessage
    {
        return (new SmsMessage(
            "0316281500",
            "text"
        ))
            -> setTtl("86400")
            -> setOriginCID("1234")
            ;
    }

    public function make_mms_message(): MmsMessage
    {
        return (new MMSMessage(
            "0316281500",
            "text"
        ))
            ->setTitle("title")
            ->setFileKey(array(
                "fileKey1"
            ))
            ->setTtl("86400")
            ;
    }

    public function make_rcs_message($content): RcsMessage
    {
        return (new RCSMessage(
            $content,
            "0316281500",
            "formatId",
            "brandKey"
        ))
            ->setBrandId("brandId")
            ->setExpiryOption("1")
            ->setCopyAllowed("1")
            ->setHeader("1")
            ->setFooter("footer")
            ->setAgencyId("agencyId")
            ->setAgencyKey("agencyKey")
            ->setTtl("86400")
            ;
    }

    public function make_rcs_standalone($button = null): RcsContent
    {
        $standalone = (new RCSStandAlone())
            ->setTitle("title")
            ->setMedia("media")
            ->setMediaUrl("mediaUrl")
            ->setSubContent(
                array(
                    new RCSSubContent(
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
        return (new RCSContent())->setStandalone($standalone);
    }

    public function make_rcs_carousel($button = null): RcsContent
    {
        $carousel = (new RCSCarousel())
            ->setTitle("title")
            ->setText("text")
            ->setMedia("media")
            ->setMediaUrl("mediaUrl");

        if ($button != null){
            $carousel->setButton(array(
                $button
            ));
        }

        return (new RCSContent)->setCarousel(array(
            $carousel,
            $carousel,
            $carousel
        ));
    }

    public function make_rcs_template(): RcsContent
    {
        $template = (new RCSTemplate())
            ->setDescription("description")
        ;

        return (new RCSContent())->setTemplate(
            $template
        );
    }

    public function make_rcs_cell(): RcsContent
    {
        $template = (new RCSTemplate())
            ->add("key1", "value1")
            ->add("key2", "value2")
        ;

        return (new RCSContent())->setTemplate(
            $template
        );
    }

    public function make_alimtalk_message($msgType, $button): AlimTalkMessage
    {
        $attachment = (new Attachment())
            ->setItem((new AttachmentItem(array(
                new AttachmentItemList("title", "description")
            ))))
            ->setItemHighlight(
                new AttachmentItemHighlight("title", "description")
            );

        if ($button != null){
            $attachment->setButton(array(
                $button
            ));
        }

        $message = (new AlimTalkMessage(
            "senderKey",
            $msgType,
            "templateCode",
            "text"
        ))
            ->setTitle("title")
            ->setAttachment($attachment)
            ->setPrice("price")
            ->setCurrencyType("KRW");

        if (in_array($button->getType(), ["WL", "AL", "BK", "BC", "BT", "BF"])){
            $message->setSupplement(
                (new Supplement(array(
                    $button
                )))
            );
        }

        return $message;
    }


    public function test_sms_message(){
        $message = (new MessageForm(
            array(
                new MessageFlow($this->make_sms_message())
            )
        ));

        $client = $this->getInfobankClient();
        $response = $client->registForm(
            $message
        );

        $this->check_assert(
            $response,
            $message
        );
    }

    public function test_mms_message(){
        $message = (new MessageForm(
            array(
                new MessageFlow($this->make_mms_message())
            )
        ));

        $client = $this->getInfobankClient();
        $response = $client->registForm(
            $message
        );

        $this->check_assert(
            $response,
            $message
        );
    }

    public function test_rcs_standalone(){
        $buttons = require __DIR__ . "/sample/makeRcsButtons.php";
        foreach ($buttons as $button){
            $message = new MessageForm(
                array(
                    new MessageFlow(
                        $this->make_rcs_message(
                            $this->make_rcs_standalone(
                                $button
                            )
                        )
                    )
                )
            );

            $client = $this->getInfobankClient();
            $response = $client->registForm(
                $message
            );

            $this->check_assert(
                $response,
                $message
            );
        }
    }

    public function test_rcs_carousel(){
        $buttons = require __DIR__ . "/sample/makeRcsButtons.php";
        foreach ($buttons as $button){
            $message = new MessageForm(
                array(
                    new MessageFlow(
                        $this->make_rcs_message(
                            $this->make_rcs_carousel(
                                $button
                            )
                        )
                    )
                )
            );

            $client = $this->getInfobankClient();
            $response = $client->registForm(
                $message
            );

            $this->check_assert(
                $response,
                $message
            );
        }
    }

    public function test_rcs_template(){
        $message = new MessageForm(
            array(
                new MessageFlow(
                    $this->make_rcs_message(
                        $this->make_rcs_template()
                    )
                )
            )
        );

        $client = $this->getInfobankClient();
        $response = $client->registForm(
            $message
        );

        $this->check_assert(
            $response,
            $message
        );
    }

    public function test_rcs_cell(){
        $message = new MessageForm(
            array(
                new MessageFlow(
                    $this->make_rcs_message(
                        $this->make_rcs_cell()
                    )
                )
            )
        );

        $client = $this->getInfobankClient();
        $response = $client->registForm(
            $message
        );

        $this->check_assert(
            $response,
            $message
        );
    }

    public function test_alimtalk_text(){
        $buttons = require __DIR__ . "/sample/makeKkoButtons.php";
        foreach ($buttons as $button){
            $message = new MessageForm(
                array(
                    new MessageFlow(
                        $this->make_alimtalk_message(
                            AlimTalkMessageTypeEnum::AT,
                            $button
                        )
                    )
                )
            );

            $client = $this->getInfobankClient();
            $response = $client->registForm(
                $message
            );

            $this->check_assert(
                $response,
                $message
            );
        }
    }

    public function test_alimtalk_image(){
        $buttons = require __DIR__ . "/sample/makeKkoButtons.php";
        foreach ($buttons as $button){
            $message = new MessageForm(
                array(
                    new MessageFlow(
                        $this->make_alimtalk_message(
                            AlimTalkMessageTypeEnum::AI,
                            $button
                        )
                    )
                )
            );

            $client = $this->getInfobankClient();
            $response = $client->registForm(
                $message
            );

            $this->check_assert(
                $response,
                $message
            );
        }
    }
}