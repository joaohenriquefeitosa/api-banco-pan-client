<?php

namespace Pan;

use Exception;
use Pan\Auth\BasicAuth;
use Pan\Resource\Covenants;

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
     * @var Covenants
     */
    private $covenants;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Client constructor.
     *
     * @param string $apiKey
     *
     * @throws \Exception
     */
    public function __construct(string $apiKey)
    {
        $this->basicAuth = new BasicAuth();
        $this->covenants = new Covenants();

        $this->apiKey = $apiKey;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return Response
     * @throws \Exception
     */
    public function authenticate(string $username, string $password) : Response
    {
        if (empty($username) or empty($password) or empty($this->apiKey)) {
            throw new Exception("Missing Parameters");
        }

        $result = $this->basicAuth->authenticate($username, $password, $this->apiKey);

        $this->accessToken = $result->getContent()["access_token"];

        return $result;
    }

    /**
     * @param string $promo_code
     *
     * @return Response
     * @throws Exception
     */
    public function covenants(string $promo_code) : Response
    {
        if (empty($promo_code) or empty($this->accessToken) or empty($this->apiKey)) {
            throw new Exception("Missing Parameters");
        }

        $result = $this->covenants->list($this->apiKey, $this->accessToken, $promo_code);

        return $result;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
