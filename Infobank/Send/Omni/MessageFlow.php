<?php

namespace Infobank\Send\Omni;

use Infobank\Core\Exceptions\InvalidMessageFlowException;
use Infobank\Send\Omni\Alimtalk\AlimTalkMessage;

class MessageFlow implements \JsonSerializable
{
    private $sms;
    private $mms;
    private $rcs;
    private $alimtalk;

    public function __construct($message)
    {
        if($message instanceof SmsMessage){
            $this->sms = $message;
        } elseif ($message instanceof MmsMessage){
            $this->mms = $message;
        } elseif ($message instanceof RcsMessage){
            $this->rcs = $message;
        } elseif ($message instanceof AlimTalkMessage){
            $this->alimtalk = $message;
        } else{
            throw new InvalidMessageFlowException("This type is not supported");
        }
    }

    public function jsonSerialize(): array
    {
        $vars = get_object_vars($this);
        $filteredVars = [];

        foreach ($vars as $key => $value) {
            if ($value !== null) {
                $filteredVars[$key] = $value;
            }
        }

        return $filteredVars;
    }
}