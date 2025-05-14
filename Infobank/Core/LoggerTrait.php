<?php

namespace Infobank\Core;
use Monolog\Logger;

trait LoggerTrait{
    protected $logger;

    public function getLogger(

    ){
        return $this->logger;
    }

    public function log(
        $level,
        $message,
        $context = [],
        $extra=[]
    ){
        $logger = $this->getLogger();
        if($logger){
            $logger->log(
                $level,
                $message,
                $context,
                $extra
            );
        }
    }

    public function setLogger(
        Logger $logger
    ){
        $this->logger = $logger;
    }
}