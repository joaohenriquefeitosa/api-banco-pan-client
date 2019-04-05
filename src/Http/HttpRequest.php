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
     * @param array $config
     * @param array $params
     *
     * @return Response
     */
    public function post(array $config, array $params = []) : Response
    {
        $ch = curl_init($config['baseApiPath'] . '/' . $config['endpoint']);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $header = $this->createHeaderAuthorization($config);

        $result = $this->sendRequest($ch, $header, $params);

        return $result;
    }

    /**
     * @param array $config
     * @param array $params
     *
     * @return Response
     */
    public function get(array $config, array $params = []) : Response
    {
        $ch = curl_init($config['baseApiPath'] . '/' . $config['endpoint']);

        curl_setopt($ch, CURLOPT_HTTPGET, TRUE);

        $header = $this->createHeaderAuthorization($config);

        $result = $this->sendRequest($ch, $header, $params);

        return $result;
    }

    /**
     * @param resource $ch
     * @param array $header
     * @param array $params
     *
     * @return Response
     */
    private function sendRequest($ch, array $header, array $params) : Response
    {
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => $header,
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
     * @param array $config
     *
     * @return array
     */
    private function createHeaderAuthorization(array $config) : array
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $config['credential']->getApiKey()
        ];

        $endpoint = $config['endpoint'];
        if ($endpoint == 'autenticacao' or $endpoint == 'usuarios')
        {
            $header['Authorization'] = 'Basic ' . base64_encode($config['credential']->getUsername() . $config['credential']->getPassword());
        }
        else
        {
            $header['Authorization'] = 'Bearer ' . $config['credential']->getAccessToken();
        }

        return $header;
    }
}