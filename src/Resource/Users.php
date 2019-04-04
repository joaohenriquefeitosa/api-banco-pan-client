<?php

namespace Pan\Resource;

use Pan\Auth\Credential;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Users
 *
 * @package Pan\Resource
 */
class Users
{
    /**
     * @const string
     */
    const ENDPOINT = 'usuarios';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * Covenants constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @param HttpRequest $httpRequest
     */
    public function setHttpRequest(HttpRequest $httpRequest): void
    {
        $this->httpRequest = $httpRequest;
    }

    /**
     * @param Credential $credential
     * @param array $args
     *
     * @return Response
     */
    public function list(Credential $credential, array $args) : Response
    {
        $cpf = $args[0];

        $params = [
            'cpf' => $cpf
        ];

        $this->httpRequest->createHeaderAuthorizationBasic64($credential->getApiKey(), $credential->getUsername(), $credential->getPassword());

        $result = $this->httpRequest->get(self::ENDPOINT, $params);

        return $result;
    }
}