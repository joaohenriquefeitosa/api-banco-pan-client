<?php


namespace Pan\Resource;


use Pan\Auth\Credencial;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Orgaos
 *
 * @package Pan\Resource
 */
class Orgaos
{
    /**
     * @const string
     */
    const ENDPOINT = 'orgaos';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * Orgaos constructor.
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
        $codigoConvenio = $args[0];

        $params = [
            'codigo_convenio' => $codigoConvenio
        ];

        $this->httpRequest->createHeaderAuthorizationBearerToken($credencial->getApiKey(), $credencial->getAccessToken());

        $result = $this->httpRequest->get(self::ENDPOINT, $params);

        return $result;
    }
}