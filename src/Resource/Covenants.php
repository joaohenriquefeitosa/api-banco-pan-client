<?php


namespace Pan\Resource;


use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Covenants
 *
 * @package Pan\Resource
 */
class Covenants
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
     * Covenants constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @param string $apiKey
     * @param string $token
     * @param string $promo_code
     *
     * @return Response
     */
    public function list(string $apiKey, string $token, string $promo_code) : Response
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $token
        ];

        $params = [
            'codigo_promotora' => $promo_code
        ];

        $result = $this->httpRequest->get($params, $header, self::ENDPOINT);

        return $result;
    }
}