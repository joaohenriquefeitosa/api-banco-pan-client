<?php

namespace Pan\Resource;

use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Affiliates
 *
 * @package Pan\Resource
 */
class Affiliates
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
     * Affiliates constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @param string $apiKey
     * @param string $accessToken
     *
     * @return Response
     */
    public function list(string $apiKey, string $accessToken) : Response
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