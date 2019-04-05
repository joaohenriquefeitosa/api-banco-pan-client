<?php


namespace Pan\Resource;


use Pan\Auth\Credential;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * Proposal
 *
 * @package Pan\Resource
 */
class Proposal
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
     * Proposal constructor.
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
     * @param array $config
     * @param array $args
     *
     * @return Response
     */
    public function simulate(array $config, array $args) : Response
    {
        $userCode = $args[0];
        $subsidiaryCode = $args[1];
        $supervisorCode = $args[2];
        $promoCode = $args[3];
        $codeAgreement = $args[4];
        $cpfClient = $args[5];
        $preferentialCustomerRegistration = $args[6];
        $customerEnrollment = $args[7];
        $customerBirthDate = $args[8];
        $customerMonthlyIncome = $args[9];
        $simulationValue = $args[10];
        $simulationMethod = $args[11];
        $termSimulation = $args[12];
        $simulationExpenses = $args[13];
        $refinancingOperations = $args[14];
        $operationType = $args[15];

        $params = [
            'codigo_usuario' => $userCode,
            'codigo_filial' => $subsidiaryCode,
            'codigo_supervisor' => $supervisorCode,
            'codigo_promotora' => $promoCode,
            'codigo_convenio' => $codeAgreement,
            'cpf_cliente' => $cpfClient,
            'matricula_preferencial_cliente' => $preferentialCustomerRegistration,
            'matricula_complementar_cliente' => $customerEnrollment,
            'data_nascimento_cliente' => $customerBirthDate,
            'renda_mensal_cliente' => $customerMonthlyIncome,
            'valor_simulacao' => $simulationValue,
            'metodo_simulacao' => $simulationMethod,
            'prazo_simulacao' => $termSimulation,
            'despesas_simulacao' => $simulationExpenses,
            'operacoes_refinanciamento' => $refinancingOperations,
            'tipo_operacao' => $operationType
        ];

        $config['endpoint'] = self::ENDPOINT;

        $result = $this->httpRequest->post($config, $params);

        return $result;
    }
}