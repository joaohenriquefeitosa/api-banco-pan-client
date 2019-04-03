<?php

namespace Pan\Resource;

use Pan\Auth\Credencial;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Usuarios
 *
 * @package Pan\Resource
 */
class Usuarios
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
     * @return HttpRequest
     */
    public function getHttpRequest(): HttpRequest
    {
        return $this->httpRequest;
    }

    /**
     * @param HttpRequest $httpRequest
     */
    public function setHttpRequest(HttpRequest $httpRequest): void
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
        $cpf = $args[0];

        $params = [
            'cpf' => $cpf
        ];

        $this->httpRequest->createHeaderAuthorizationBasic64($credencial->getApiKey(), $credencial->getUsername(), $credencial->getPassword());

        $result = $this->httpRequest->get(self::ENDPOINT, $params);

        return $result;
    }
}