<?php


namespace Pan\Resource;


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
    const ENDPOINT = '5ca3ca794b0000600020981a';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @param string $apiKey
     * @param string $accessToken
     * @param string $codigoConvenio
     * @param string $tipoOperacao
     * @param string $cepCliente
     * @param string $valorCliente
     *
     * @return \Pan\Response
     */
    public function listar(string $apiKey, string $accessToken, string $codigoConvenio, string $tipoOperacao, string $cepCliente, string $valorCliente)
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $accessToken
        ];

        $params = [
            'codigo_convenio' => $codigoConvenio,
            'tipo_operacao' => $tipoOperacao,
            'cep_cliente' => $cepCliente,
            'valor_cliente' => $valorCliente
        ];

        $result = $this->httpRequest->get(self::ENDPOINT, $header, $params);

        return $result;
    }
}