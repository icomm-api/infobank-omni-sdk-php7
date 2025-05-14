<?php

namespace Infobank\Regist\Form;

use Infobank\Core\Exceptions\InvalidMessageFormException;
use Infobank\Send\Omni\MessageFlow;

class MessageForm implements \JsonSerializable
{
    private $messageForm;

    public function __construct(array $messageForm)
    {
        foreach ($messageForm as $item) {
            if (!$item instanceof MessageFlow) {
                throw new InvalidMessageFormException('messageForm array must contain instances of MessageFlow.');
            }
        }

        $this->messageForm = $messageForm;
    }

    public function getMessageForm(): array
    {
        return $this->messageForm;
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