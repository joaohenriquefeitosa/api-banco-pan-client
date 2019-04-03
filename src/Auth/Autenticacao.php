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
    const ENDPOINT = 'autenticacao';

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
     * @param Credencial $credencial
     * @param array $args
     *
     * @return Response
     */
    public function autenticar(Credencial $credencial, array $args) : Response
    {
        $username = $args[0];
        $password = $args[1];

        $params = [
            'username' => $username,
            'password' => $password,
            'grant_type' => $username . $password
        ];

        $this->httpRequest->createHeaderAuthorizationBasic64($credencial->getApiKey(), $credencial->getUsername(), $credencial->getPassword());

        $result = $this->httpRequest->post(self::ENDPOINT, $params);

        return $result;
    }
}