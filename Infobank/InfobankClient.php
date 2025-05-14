<?php

declare(strict_types=1);

namespace Infobank;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\RequestOptions;
use Infobank\Auth\TokenData;
use Infobank\Core\ApiResponse;
use Infobank\Core\Endpoints;
use Infobank\Core\Exceptions\InvalidMessageTypeException;
use Infobank\Core\Exceptions\InvalidPathParamException;
use Infobank\Core\RestClient;
use Infobank\Regist\Form\MessageForm;
use Infobank\Regist\ImgFile\ImageFile;
use Infobank\Send\Inter\InterMessage;
use Infobank\Send\Kko\AlimTalk\AlimTalkMessage;
use Infobank\Send\Kko\FriendTalk\FriendTalkMessage;
use Infobank\Send\Mms\MmsMessage;
use Infobank\Send\Omni\OmniMessage;
use Infobank\Send\Rcs\RcsMessage;
use Infobank\Send\Sms\SmsMessage;
use Infobank\Core\LoggerTrait;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;

date_default_timezone_set('Asia/Seoul');

class InfobankClient
{
    use LoggerTrait;

    private $baseUrl;
    private $clientId;
    private $password;

    private $logFileFullPath = "";
    private $debug = false;

    private $client = null;
    private $timeout = 1;
    private $tokenData;

    private $restClient;
    private $endpoints;

    public function __construct(string $baseUrl, string $token, string $clientId, string $password) {
        if (!filter_var($baseUrl, FILTER_VALIDATE_URL) || !preg_match("~^(?:f|ht)tps?://~i", $baseUrl)){
            throw new \InvalidArgumentException($baseUrl." not allowd url format");
        }

        if ($clientId==null || strlen($clientId)==0 || $password==null || strlen($password)==0){
            throw new \InvalidArgumentException("Invalid account information.");
        }

        $this->baseUrl = $baseUrl;
        $this->clientId = $clientId;
        $this->password = $password;

        $this->client = $this->getClient();
        $this->restClient = new RestClient($this->client);
        $this->endpoints = new Endpoints();

        if($token!=null && strlen($token)!=0){
            $tokenData = new TokenData(null);
            $tokenData->setSchema("Bearer");
            $tokenData->setToken($token);
            $this->tokenData = $tokenData;
            echo "input token use ". json_encode($tokenData);
        }else{
            $this->tokenData = $this->restClient->getToken($this->endpoints->getAuthEndpoint(), $this->getAuthOptions());
            echo "new token use ". json_encode($this->tokenData);
        }
    }

    public function setClient(GuzzleHttpClient  $client): void
    {
        $this->client = $client;
    }

    public function getClient(): GuzzleHttpClient
    {
        if (null === $this->client) {
            $this->createDefaultClient();
        }

        return $this->client;
    }

    private function createDefaultClient()
    {
        $client = new GuzzleHttpClient([
            'verify' => false,
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $this->setClient($client);
    }

    /**
     * @param string $logFileFullPath 로그 파일 전체 경로
     * @param bool $debug debug 로그 생성 유무[true|false]
     */
    public function setSdkDebugLog(
        string $logFileFullPath,
        bool $debug = true
    ){
        $this->logFileFullPath = $logFileFullPath;
        $this->debug = $debug;

        if ($debug == true){
            if($this->getLogger() == null){
                $this->setLogger(
                    new Logger('Infobank')
                );
            }

            if ($logFileFullPath != null && sizeof($logFileFullPath) > 0){
                $streamHandler = new StreamHandler($logFileFullPath, Logger::DEBUG);
                $this->getLogger()->pushHandler($streamHandler);
            }
        }
    }

    public function sendMessage($message): ?Send\ApiResponse
    {
        $response = null;
        $data = array_merge_recursive(
            $this->getDefaultOptions(),
            $this->getBody($message)
        );

        if($message instanceof SmsMessage){
            $response =  $this->restClient->sendMessage($this->endpoints->getSendSmsEndpoint(), $data);
        }elseif ($message instanceof InterMessage){
            $response =  $this->restClient->sendMessage($this->endpoints->getSendInterEndpoint(), $data);
        }elseif ($message instanceof MmsMessage){
            $response =  $this->restClient->sendMessage($this->endpoints->getSendMmsEndpoint(), $data);
        }elseif ($message instanceof RcsMessage){
            $response =  $this->restClient->sendMessage($this->endpoints->getSendRcsEndpoint(), $data);
        }elseif ($message instanceof AlimTalkMessage){
            $response =  $this->restClient->sendMessage($this->endpoints->getSendAlimtalkEndpoint(), $data);
        }elseif ($message instanceof FriendTalkMessage){
            $response =  $this->restClient->sendMessage($this->endpoints->getSendFriendtalkEndpoint(), $data);
        }elseif ($message instanceof OmniMessage){
            $response =  $this->restClient->sendMessage($this->endpoints->getSendOmniEndpoint(), $data);
        }else{
            throw new InvalidMessageTypeException(gettype($message).' is not supported.');
        }

        if ($this->debug == true){
            $this->log(
                LogLevel::DEBUG,
                'Response:' . json_encode($response)
            );
        }

        return $response;
    }

    public function registImgFile(ImageFile $file): ?ApiResponse
    {
        $imageStream = new Stream(fopen($file->getFileName(), 'r'));
        $multipart = [
            [
                'name' => 'file', // 필드 이름
                'contents' => $imageStream, // 파일 스트림
                'filename' => 'image.jpg' // 파일 이름
            ]
        ];

        $data = array_merge_recursive(
            $this->getFileOptions(),
            [
                RequestOptions::MULTIPART => $multipart
            ]
        );

        // path parameter setting
        $url = $this->endpoints->getFileEndpoint(). "/" .$file->getServiceType();
        $response = $this->restClient->registFile($url, $data);

        if ($this->debug == true){
            $this->log(
                LogLevel::DEBUG,
                'Response:' . json_encode($response)
            );
        }
        return $response;
    }

    public function registForm(MessageForm $form): ?ApiResponse
    {
        $data = array_merge_recursive(
            $this->getDefaultOptions(),
            $this->getBody($form)
        );

        $response = $this->restClient->registForm($this->endpoints->getFormEndpoint(),$data);

        if ($this->debug == true){
            $this->log(
                LogLevel::DEBUG,
                'Response:' . json_encode($response)
            );
        }
        return $response;
    }

    public function getForm(string $formId): ?ApiResponse
    {
        if(strlen($formId) > 0 ){
            $data = array_merge_recursive(
                $this->getDefaultOptions()
            );
            $url = $this->endpoints->getFormEndpoint(). "/" .$formId;

            $response = $this->restClient->getForm($url, $data);

            if ($this->debug == true){
                $this->log(
                    LogLevel::DEBUG,
                    'Response:' . json_encode($response)
                );
            }
            return $response;
        }else{
            throw new InvalidPathParamException('The value of formId cannot be null or empty.');
        }
    }

    public function modifyForm(string $formId, MessageForm $form): ?ApiResponse
    {
        if(strlen($formId) > 0 ){
            $data = array_merge_recursive(
                $this->getDefaultOptions(),
                $this->getBody($form)
            );

            $url = $this->endpoints->getFormEndpoint(). "/" .$formId;

            $response = $this->restClient->modifyForm($url, $data);

            if ($this->debug == true){
                $this->log(
                    LogLevel::DEBUG,
                    'Response:' . json_encode($response)
                );
            }
            return $response;
        }else{
            throw new InvalidPathParamException('The value of formId cannot be null or empty.');
        }
    }

    public function deleteForm(string $formId): ?ApiResponse
    {
        if(strlen($formId) > 0 ){
            $data = array_merge_recursive(
                $this->getDefaultOptions()
            );
            $url = $this->endpoints->getFormEndpoint(). "/" .$formId;

            $response = $this->restClient->deleteForm($url, $data);

            if ($this->debug == true){
                $this->log(
                    LogLevel::DEBUG,
                    'Response:' . json_encode($response)
                );
            }
            return $response;
        }else{
            throw new InvalidPathParamException('The value of formId cannot be null or empty.');
        }
    }

    public function reportPollingGet(): ?ApiResponse
    {
        $data = array_merge_recursive(
            $this->getDefaultOptions()
        );

        $response = $this->restClient->reportPollingGet($this->endpoints->getReportPollingEndpoint(), $data);

        if ($this->debug == true){
            $this->log(
                LogLevel::DEBUG,
                'Response:' . json_encode($response)
            );
        }
        return $response;
    }

    public function reportPollingDel(string $reportId): ?ApiResponse
    {
        if (strlen($reportId) > 0 ){
            $data = array_merge_recursive(
                $this->getDefaultOptions()
            );
            $url = $this->endpoints->getReportPollingEndpoint(). "/" .$reportId;

            $response = $this->restClient->reportPollingDel($url, $data);

            if ($this->debug == true){
                $this->log(
                    LogLevel::DEBUG,
                    'Response:' . json_encode($response)
                );
            }
            return $response;
        }else{
            throw new InvalidPathParamException('The value of reportId cannot be null or empty.');
        }
    }


    private function getAuthOptions(): array
    {
        return [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'X-IB-Client-Id' => $this->clientId,
                'X-IB-Client-Passwd' => $this->password
            ]
        ];
    }

    private function getDefaultOptions(): array
    {
        if(!$this->tokenData->isTokenValid())
        {
            $this->tokenData = $this->restClient->getToken($this->endpoints->getAuthEndpoint(), $this->getAuthOptions());
        }

        return [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => $this->tokenData->getAuthorization()
            ],
        ];
    }

    private function getFileOptions(): array
    {
        if(!$this->tokenData->isTokenValid())
        {
            $this->tokenData = $this->restClient->getToken($this->endpoints->getAuthEndpoint(), $this->getAuthOptions());
        }

        return [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                // 'Content-Type' => 'multipart/form-data', // ** 해당 라인을 작성하면 GuzzleHttp 에서 자동으로 추가해주는 boundary 값이 추가되지 않아 에러가 발생함.
                'Authorization' => $this->tokenData->getAuthorization()
            ]
        ];
    }

    private function getBody($message): array
    {
        return [
            RequestOptions::BODY => json_encode($message)
        ];
    }
}