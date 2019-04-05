<?php

namespace Pan\Auth;

use Exception;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Authentication
 *
 * @package Pan\Auth
 */
class Authentication
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
     * Authentication constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @param HttpRequest $httpRequest
     */
    public function setHttpRequest(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    /**
     * @param array $config
     * @param array $args
     *
     * @return Response
     */
    public function authenticate(array $config, array $args) : Response
    {
        $username = $args[0];
        $password = $args[1];

        $params = [
            'username' => $username,
            'password' => $password,
            'grant_type' => $username . $password
        ];

        $config['endpoint'] = self::ENDPOINT;

        $result = $this->httpRequest->post($config, $params);

        return $result;
    }
}