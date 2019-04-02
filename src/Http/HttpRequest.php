<?php

namespace Pan\Http;

use Exception;
use Pan\Response;

/**
 * Post
 *
 * @package Pan\Connect
 */
class HttpRequest
{
    const API_BASE_PATH = 'http://www.mocky.io/v2/';

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
     * @param array $header
     * @param $endpoint
     *
     * @return Response
     */
    public function post($params, $header, $endpoint) : Response
    {
        $ch = curl_init(self::API_BASE_PATH . $endpoint);

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POST => TRUE,
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
     * @param array $params
     * @param array $header
     * @param $endpoint
     *
     * @return Response
     */
    public function get($params, $header, $endpoint) : Response
    {
        $ch = curl_init(self::API_BASE_PATH . $endpoint);

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HTTPGET => TRUE,
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
}