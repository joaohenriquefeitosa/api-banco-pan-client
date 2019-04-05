<?php

namespace Pan\Resource;

use Pan\Auth\Credential;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Covenants
 *
 * @package Pan\Resource
 */
class Covenants
{
    /**
     * @const string
     */
    const ENDPOINT = 'convenios';

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
    public function list(array $config, array $args) : Response
    {
        $promoterCode = $args[0];

        $params = [
            'codigo_promotora' => $promoterCode
        ];

        $config['endpoint'] = self::ENDPOINT;

        $result = $this->httpRequest->get($config, $params);

        return $result;
    }
}