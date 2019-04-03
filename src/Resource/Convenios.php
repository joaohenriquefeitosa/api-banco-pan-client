<?php

namespace Pan\Resource;

use Pan\Auth\Credencial;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Convenios
 *
 * @package Pan\Resource
 */
class Convenios
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
     * Convenios constructor.
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
     * @param array $args
     *
     * @return Response
     */
    public function listar(Credencial $credencial, array $args) : Response
    {
        $codigoPromotora = $args[0];

        $params = [
            'codigo_promotora' => $codigoPromotora
        ];

        $this->httpRequest->createHeaderAuthorizationBearerToken($credencial->getApiKey(), $credencial->getAccessToken());

        $result = $this->httpRequest->get(self::ENDPOINT, $params);

        return $result;
    }
}