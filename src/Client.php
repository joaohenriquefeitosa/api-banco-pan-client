<?php

namespace Pan;

use Pan\Auth\BasicAuth;

/**
 * Client
 */
class Client
{

    /**
     * @var BasicAuth
     */
    private $basicAuth;

    /**
     * Client constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->basicAuth = new BasicAuth();
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $apiKey
     *
     * @return string
     * @throws \Exception
     */
    public function authenticate(string $username, string $password, string $apiKey)
    {
        $result = $this->basicAuth->authenticate($username, $password, $apiKey);

        return $result;
    }
}
