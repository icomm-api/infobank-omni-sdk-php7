<?php

namespace Infobank\Send\Omni;

class ResponseData
{
    private $destinations;

    public function __construct(
        array $destinations
    ){
        $this->destinations = $destinations;
    }

    /**
     * @return array 수신 정보 별 접수 결과
     */
    public function getDestinations(): array
    {
        $destinations = [];
        foreach ($this->destinations as $value) {
            foreach ($value as $data) {
                $destinations[] = new ResponseDestinations(
                    $data['to'],
                    $data['msgKey'],
                    $data['code'],
                    $data['result']
                );
            }
        }
        return $destinations;
    }
}