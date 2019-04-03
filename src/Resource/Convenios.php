<?php

namespace Pan\Resource;

use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Convenios
 *
 * @package Pan\Resource
 */
class Convenios
{
    /**
     * @const string
     */
    const ENDPOINT = '5ca397924b00004e00209720';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * Convenios constructor.
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
     * @param string $codigoPromotora
     *
     * @return Response
     */
    public function listar(string $apiKey, string $accessToken, string $codigoPromotora) : Response
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $accessToken
        ];

        $params = [
            'codigo_promotora' => $codigoPromotora
        ];

        $result = $this->httpRequest->get(self::ENDPOINT, $header, $params);

        return $result;
    }
}