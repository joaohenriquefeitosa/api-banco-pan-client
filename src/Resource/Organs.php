<?php


namespace Pan\Resource;


use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Organs
 *
 * @package Pan\Resource
 */
class Organs
{
    /**
     * @const string
     */
    const ENDPOINT = '5ca497934b00002b63209c8d';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * Organs constructor.
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
     * @param string $codigo_convenio
     *
     * @return Response
     */
    public function list(string $apiKey, string $accessToken, string $codigo_convenio) : Response
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $accessToken
        ];

        $params = [
            'codigo_convenio' => $codigo_convenio
        ];

        $result = $this->httpRequest->get(self::ENDPOINT, $header, $params);

        return $result;
    }
}