<?php

namespace Pan\Auth;

use Exception;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * BasicAuth
 *
 * @package Pan\Auth
 */
class BasicAuth
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
     * @return Response
     * @throws Exception
     */
    public function authenticate(string $username, string $password, string $apiKey) : Response
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