<?php


namespace Pan\Resource;


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
    const ENDPOINT = '5ca497934b00002b63209c8d';

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
     * @param string $apiKey
     * @param string $accessToken
     * @param string $codigoConvenio
     *
     * @return Response
     */
    public function listar(string $apiKey, string $accessToken, string $codigoConvenio) : Response
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $accessToken
        ];

        $params = [
            'codigo_convenio' => $codigoConvenio
        ];

        $result = $this->httpRequest->get(self::ENDPOINT, $header, $params);

        return $result;
    }
}