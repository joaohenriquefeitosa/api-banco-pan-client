<?php

namespace Pan\Http;

use Exception;
use Pan\Response;

/**
 * HttpRequest
 *
 * @codeCoverageIgnore
 * @package Pan\Connect
 */
class HttpRequest
{
    const API_BASE_PATH = 'https://sandbox.bancopan.com.br/consignado/v1/';

    /**
     * @var object
     */
    private $header;

    /**
     * HttpRequest constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new Exception('cURL library is not loaded');
        }
    }

    /**
     * @param array $params
     * @param string $endpoint
     *
     * @return Response
     */
    public function post(string $endpoint, array $params = []) : Response
    {
        $ch = curl_init(self::API_BASE_PATH . $endpoint);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $result = $this->sendRequest($ch, $params);

        return $result;
    }

    /**
     * @param string $endpoint
     * @param array $params
     *
     * @return Response
     */
    public function get(string $endpoint, array $params = []) : Response
    {
        $ch = curl_init(self::API_BASE_PATH . $endpoint);

        curl_setopt($ch, CURLOPT_HTTPGET, TRUE);

        $result = $this->sendRequest($ch, $params);

        return $result;
    }

    /**
     * @param resource $ch
     * @param array $params
     *
     * @return Response
     */
    private function sendRequest($ch, array $params) : Response
    {
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => $this->header,
            CURLOPT_USERAGENT => "PHP SDK",
            CURLOPT_REFERER => $_SERVER['REMOTE_ADDR'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_POSTFIELDS => json_encode($params)
        ]);

        $result = new Response();
        $result->setContent(json_decode(curl_exec($ch), true));

        $info = curl_getinfo($ch);
        $result->setStatusCode($info['http_code']);

        curl_close($ch);

        return $result;
    }

    /**
     * @param string $apiKey
     * @param string $username
     * @param $password
     */
    public function createHeaderAuthorizationBasic64(string $apiKey, string $username, string $password) : void
    {
        $this->header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Basic ' . base64_encode($username . $password)
        ];
    }

    /**
     * @param string $apiKey
     * @param string $accessToken
     */
    public function createHeaderAuthorizationBearerToken(string $apiKey, string $accessToken) : void
    {
        $this->header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $accessToken
        ];
    }
}