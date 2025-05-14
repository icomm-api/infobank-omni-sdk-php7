<?php

namespace Infobank\Auth;

use DateTime;

class TokenData implements \JsonSerializable
{
    private $token;
    private $schema;
    private $expired;

    public function __construct($data){
        if($data!=null){
            $this->jsonDeserialize($data);
            $this->setExpired($this->expired);
        }
    }

    public function setToken($token): void
    {
        $this->token = $token;
    }

    public function setSchema($schema): void
    {
        $this->schema = $schema;
    }

    public function setExpired($expired): TokenData
    {
        $this->expired = $expired;
        return $this;
    }

    public function getAuthorization(): string
    {
        return $this->schema." ".$this->token;
    }

    public function isTokenValid(): bool
    {
        if($this->expired==null){
            return true;
        }

        $currentDateTime = new DateTime();
        $tokenExpirationDateTime = new DateTime($this->expired);

        return $currentDateTime < $tokenExpirationDateTime;
    }

    public function jsonDeserialize($jsonString) {
        $data = json_decode($jsonString, true);

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
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