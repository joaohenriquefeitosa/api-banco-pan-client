<?php

namespace Pan\Resource;

use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Filiais
 *
 * @package Pan\Resource
 */
class Filiais
{
    /**
     * @const string
     */
    const ENDPOINT = '5ca3b0974b00004e002097bc';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * Filiais constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @return HttpRequest
     */
    public function getHttpRequest(): HttpRequest
    {
        return $this->httpRequest;
    }

    /**
     * @param HttpRequest $httpRequest
     */
    public function setHttpRequest(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    /**
     * @param string $apiKey
     * @param string $accessToken
     *
     * @return Response
     */
    public function listar(string $apiKey, string $accessToken) : Response
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $accessToken
        ];

        $result = $this->httpRequest->get(self::ENDPOINT, $header);

        return $result;
    }
}