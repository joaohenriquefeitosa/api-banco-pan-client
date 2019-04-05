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
     * @param array $config
     * @param array $args
     *
     * @return Response
     */
    public function list(array $config, array $args) : Response
    {
        $cpf = $args[0];

        $params = [
            'cpf' => $cpf
        ];

        $config['endpoint'] = self::ENDPOINT;

        $result = $this->httpRequest->get($config, $params);

        return $result;
    }
}