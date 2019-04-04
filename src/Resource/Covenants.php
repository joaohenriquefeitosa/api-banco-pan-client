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
     * @param Credential $credential
     * @param array $args
     *
     * @return Response
     */
    public function list(Credential $credential, array $args) : Response
    {
        $promoterCode = $args[0];

        $params = [
            'codigo_promotora' => $promoterCode
        ];

        $this->httpRequest->createHeaderAuthorizationBearerToken($credential->getApiKey(), $credential->getAccessToken());

        $result = $this->httpRequest->get(self::ENDPOINT, $params);

        return $result;
    }
}