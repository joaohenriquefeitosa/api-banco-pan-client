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

    public function listar(string $apiKey, string $accessToken, string $codigo_convenio, string $tipo_operacao, string $cep_cliente, string $valor_cliente)
    {
        $header = [
            'Content-type' => 'application/json',
            'Api-Key' => $apiKey,
            'Authorization' => 'Bearer ' . $accessToken
        ];

        $params = [
            'codigo_convenio' => $codigo_convenio,
            'tipo_operacao' => $tipo_operacao,
            'cep_cliente' => $cep_cliente,
            'valor_cliente' => $valor_cliente
        ];

        $result = $this->httpRequest->get(self::ENDPOINT, $header, $params);

        return $result;
    }
}