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
     * @param string $apiKey
     * @param string $accessToken
     * @param string $promo_code
     *
     * @return Response
     */
    public function listar(string $apiKey, string $accessToken, string $promo_code) : Response
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $accessToken
        ];

        $params = [
            'codigo_promotora' => $promo_code
        ];

        $result = $this->httpRequest->get(self::ENDPOINT, $header, $params);

        return $result;
    }
}