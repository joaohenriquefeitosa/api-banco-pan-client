<?php

namespace Pan\Resource;

use Pan\Auth\Credential;
use Pan\Http\HttpRequest;
use Pan\Response;

/**
 * InstitutionalAffiliates
 *
 * @package Pan\Resource
 */
class InstitutionalAffiliates
{
    /**
     * @const string
     */
    const ENDPOINT = 'filiais';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * InstitutionalAffiliates constructor.
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
     *
     * @return Response
     */
    public function list(array $config) : Response
    {
        $config['endpoint'] = self::ENDPOINT;

        $result = $this->httpRequest->get($config);

        return $result;
    }
}