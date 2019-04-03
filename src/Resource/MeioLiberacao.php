<?php


namespace Pan\Resource;


use Pan\Auth\Credencial;
use Pan\Http\HttpRequest;

/**
 * MeioLiberacao
 *
 * @package Pan\Resource
 */
class MeioLiberacao
{
    /**
     * @const string
     */
    const ENDPOINT = 'meio-liberacao';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * MeioLiberacao constructor.
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
     * @return \Pan\Response
     */
    public function listar(Credencial $credencial, array $args)
    {
        $codigoConvenio = $args[0];
        $tipoOperacao = $args[1];
        $cepCliente = $args[2];
        $valorCliente = $args[3];

        $params = [
            'codigo_convenio' => $codigoConvenio,
            'tipo_operacao' => $tipoOperacao,
            'cep_cliente' => $cepCliente,
            'valor_cliente' => $valorCliente
        ];

        $this->httpRequest->createHeaderAuthorizationBearerToken($credencial->getApiKey(), $credencial->getAccessToken());

        $result = $this->httpRequest->get(self::ENDPOINT, $params);

        return $result;
    }
}