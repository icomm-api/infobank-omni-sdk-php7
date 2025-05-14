<?php

namespace Infobank\Send\Omni;

use Infobank\Core\Exceptions\InvalidOmniException;

class OmniMessage  implements \JsonSerializable
{
    private $destinations;
    private $messageFlow;
    private $messageForm;
    private $paymentCode;
    private $ref;

    public function __construct(
        array $destinations
    ){
        foreach ($destinations as $item) {
            if (!$item instanceof Destinations) {
                throw new InvalidOmniException('destinations array must contain instances of Destinations.');
            }
        }

        $this->destinations = $destinations;
    }

    public function __toString() {
        return "Destinations: " . json_encode($this->destinations) . "\n" .
            "Message Flow: " . json_encode($this->messageFlow) . "\n" .
            "Message Form: " . $this->messageForm . "\n" .
            "Payment Code: " . $this->paymentCode . "\n" .
            "Ref: " . $this->ref;
    }

    /**
     * @param MessageFlow $messageFlow 메시지 정보 리스트
     */
    public function addMessageFlow(MessageFlow $messageFlow): OmniMessage
    {
        $this->messageFlow[] = $messageFlow;
        return $this;
    }

    /**
     * @param string $messageForm 메시지 폼 ID
     * @return $this
     *
     */
    public function setMessageForm(string $messageForm): OmniMessage
    {
        $this->messageForm = $messageForm;
        return $this;
    }

    /**
     * @param string $paymentCode 정산용 부서코드
     * @return $this
     *
     */
    public function setPaymentCode(string $paymentCode): OmniMessage
    {
        $this->paymentCode = $paymentCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * @param string $ref 참조필드
     * @return $this
     *
     */
    public function setRef(string $ref): OmniMessage
    {
        $this->ref = $ref;
        return $this;
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