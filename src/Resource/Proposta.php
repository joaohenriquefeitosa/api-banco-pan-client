<?php


namespace Pan\Resource;


use Pan\Auth\Credencial;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Proposta
 *
 * @package Pan\Resource
 */
class Proposta
{
    /**
     * @const string
     */
    const ENDPOINT = 'proposta/simulacao';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * Proposta constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @return HttpRequest
     *
     * @throws \Exception
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
    public function simular(Credencial $credencial, array $args) : Response
    {
        $codigoUsuario = $args[0];
        $codigoFilial = $args[1];
        $codigoSupervisor = $args[2];
        $codigoPromotora = $args[3];
        $codigoConvenio = $args[4];
        $cpfCliente = $args[5];
        $matriculaPreferencialCliente = $args[6];
        $matriculaComplementarCliente = $args[7];
        $dataNascimentoCliente = $args[8];
        $rendaMensalCliente = $args[9];
        $valorSimulacao = $args[10];
        $metodoSimulacao = $args[11];
        $prazoSimulacao = $args[12];
        $despesasSimulacao = $args[13];
        $operacoesRefinanciamento = $args[14];
        $tipoOperacao = $args[15];

        $params = [
            'codigo_usuario' => $codigoUsuario,
            'codigo_filial' => $codigoFilial,
            'codigo_supervisor' => $codigoSupervisor,
            'codigo_promotora' => $codigoPromotora,
            'codigo_convenio' => $codigoConvenio,
            'cpf_cliente' => $cpfCliente,
            'matricula_preferencial_cliente' => $matriculaPreferencialCliente,
            'matricula_complementar_cliente' => $matriculaComplementarCliente,
            'data_nascimento_cliente' => $dataNascimentoCliente,
            'renda_mensal_cliente' => $rendaMensalCliente,
            'valor_simulacao' => $valorSimulacao,
            'metodo_simulacao' => $metodoSimulacao,
            'prazo_simulacao' => $prazoSimulacao,
            'despesas_simulacao' => $despesasSimulacao,
            'operacoes_refinanciamento' => $operacoesRefinanciamento,
            'tipo_operacao' => $tipoOperacao
        ];

        $this->httpRequest->createHeaderAuthorizationBearerToken($credencial->getApiKey(), $credencial->getAccessToken());

        $result = $this->httpRequest->post(self::ENDPOINT, $params);

        return $result;
    }
}