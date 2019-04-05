<?php


namespace Pan\Resource;


use Pan\Auth\Credential;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * InstitutionalBodies
 *
 * @package Pan\Resource
 */
class InstitutionalBodies
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
     * InstitutionalBodies constructor.
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
    public function list(array $config, array $args) : Response
    {
        $codeAgreement = $args[0];

        $params = [
            'codigo_convenio' => $codeAgreement
        ];

        $config['endpoint'] = self::ENDPOINT;

        $result = $this->httpRequest->get($config, $params);

        return $result;
    }
}