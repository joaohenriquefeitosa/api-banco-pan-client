<?php


namespace Pan\Resource;


use Pan\Auth\Credential;
use Pan\Http\HttpRequest;

/**
 * ReleaseMedium
 *
 * @package Pan\Resource
 */
class ReleaseMedium
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
     * ReleaseMedium constructor.
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
     * @param Credential $credencial
     * @param array $args
     *
     * @return \Pan\Response
     */
    public function list(Credential $credencial, array $args)
    {
        $codeAgreement = $args[0];
        $operationType = $args[1];
        $customerZipCode = $args[2];
        $customerValue = $args[3];

        $params = [
            'codigo_convenio' => $codeAgreement,
            'tipo_operacao' => $operationType,
            'cep_cliente' => $customerZipCode,
            'valor_cliente' => $customerValue
        ];

        $this->httpRequest->createHeaderAuthorizationBearerToken($credencial->getApiKey(), $credencial->getAccessToken());

        $result = $this->httpRequest->get(self::ENDPOINT, $params);

        return $result;
    }
}