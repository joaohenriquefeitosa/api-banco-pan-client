<?php

namespace Pan\Auth;

use Exception;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Autenticacao
 *
 * @package Pan\Auth
 */
class Autenticacao
{
    /**
     * @const string
     */
    const ENDPOINT = '5ca397284b00002e0020971d';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * Autenticacao constructor.
     *
     * @throws Exception
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
     * @param string $username
     * @param string $password
     * @param string $apiKey
     *
     * @return Response
     * @throws Exception
     */
    public function autenticar(string $username, string $password, string $apiKey) : Response
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Basic ' . base64_encode($username . $password)
        ];

        $params = [
            'username' => $username,
            'password' => $password,
            'grant_type' => $username . $password
        ];

        $result = $this->httpRequest->post(self::ENDPOINT, $header, $params);

        return $result;
    }
}