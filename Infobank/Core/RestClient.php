<?php

declare(strict_types=1);

namespace Infobank\Core;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Infobank\Auth\TokenData;
use Infobank\Core\Exceptions\AuthenticationException;
use Infobank\Core\Exceptions\HttpRequestException;

class RestClient
{
    private $client = null;

    public function __construct(GuzzleHttpClient $client)
    {
        $this->client = $client;
    }

    public function getToken(string $endpoint, array $data): ?TokenData
    {
        $tokenData = null;
        try {
            $response = $this->client->post($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Auth\ApiResponse($statusCode, $responseData);

            if($apiResponse->getHttpCode()=="200" && $apiResponse->getCode()=="A000"){
                $tokenData = $apiResponse->getData();
            }else{
                throw new AuthenticationException("code:" . $statusCode . ", responseData : ".$responseData."\n");
            }
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $tokenData;
    }

    public function sendMessage(string $endpoint, array $data): ?ApiResponse
    {
        $apiResponse = null;
        try {
            $response = $this->client->post($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Send\ApiResponse($statusCode, $responseData);
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $apiResponse;
    }

    public function registForm(string $endpoint, array $data): ?\Infobank\Regist\ApiResponse
    {
        // 메시지 폼 등록 POST 요청
        $apiResponse = null;
        try {
            $response = $this->client->post($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Regist\ApiResponse($statusCode, $responseData);
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $apiResponse;
    }

    public function getForm(string $endpoint, array $data): ?\Infobank\Regist\ApiResponse
    {
        // 메시지 폼 조회 GET 요청
        $apiResponse = null;
        try {
            $response = $this->client->get($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Regist\ApiResponse($statusCode, $responseData);
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $apiResponse;
    }

    public function modifyForm(string $endpoint, array $data): ?\Infobank\Regist\ApiResponse
    {
        // 메시지 폼 수정 PUT 요청
        $apiResponse = null;
        try {
            $response = $this->client->put($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Regist\ApiResponse($statusCode, $responseData);
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $apiResponse;

    }

    public function deleteForm(string $endpoint, array $data): ?\Infobank\Regist\ApiResponse
    {
        // 메시지 폼 삭제 DELETE 요청
        $apiResponse = null;
        try {
            $response = $this->client->delete($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Regist\ApiResponse($statusCode, $responseData);
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $apiResponse;
    }

    public function registFile(string $endpoint, array $data): ?\Infobank\Regist\ApiResponse
    {
        $apiResponse = null;
        try {
            $response = $this->client->post($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Regist\ApiResponse($statusCode, $responseData);
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $apiResponse;
    }

    public function reportPollingGet(string $endpoint, array $data)
    {
        $apiResponse = null;
        try {
            $response = $this->client->get($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Report\ApiResponse($statusCode, $responseData);
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $apiResponse;
    }

    public function reportPollingDel(string $endpoint, array $data)
    {
        $apiResponse = null;
        try {
            $response = $this->client->delete($endpoint, $data);

            $statusCode = $response->getStatusCode();
            $responseData = $response->getBody()->getContents();

            $apiResponse = new \Infobank\Report\ApiResponse($statusCode, $responseData);
        } catch (GuzzleException $e) {
            throw new HttpRequestException("code:" . $e->getCode() . ", message : ".$e->getMessage()."\n");
        }
        return $apiResponse;
    }
}