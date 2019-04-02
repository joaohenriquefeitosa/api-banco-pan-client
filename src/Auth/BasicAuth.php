<?php

namespace Pan\Auth;

use Exception;
use Pan\Http\HttpRequest;

/**
 * BasicAuth
 *
 * @package Pan\Auth
 */
class BasicAuth
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * BasicAuth constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $apiKey
     *
     * @return string
     * @throws Exception
     */
    public function authenticate(string $username, string $password, string $apiKey)
    {
        if (empty($username) or empty($password) or empty($apiKey)) {
            throw new Exception("Missing Parameters");
        }

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

        $result = $this->httpRequest->post($params, $header, 'authenticate');

        $this->setAccessToken($result->getContent()["access_token"]);

        return $result;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}