<?php

namespace Infobank\Regist\Form;

class ResponseData implements \JsonSerializable
{
    private $formId;
    private $messageForm;
    private $expired;

    public function __construct($formId, $messageForm, $expired)
    {
        $this->formId = $formId;
        $this->messageForm = $messageForm;
        $this->expired = $expired;
    }

    public function getFormId()
    {
        return $this->formId;
    }

    public function getMessageForm()
    {
        return $this->messageForm;
    }

    public function getExpired()
    {
        return $this->expired;
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