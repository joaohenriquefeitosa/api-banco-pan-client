<?php

namespace Pan\Resource;

use Pan\Auth\Credencial;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Filiais
 *
 * @package Pan\Resource
 */
class Filiais
{
    /**
     * @const string
     */
    const ENDPOINT = 'filiais';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * Filiais constructor.
     *
     * @throws \Exception
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
     *
     * @return Response
     */
    public function listar(Credencial $credencial) : Response
    {
        $this->httpRequest->createHeaderAuthorizationBearerToken($credencial->getApiKey(), $credencial->getAccessToken());

        $result = $this->httpRequest->get(self::ENDPOINT);

        return $result;
    }
}