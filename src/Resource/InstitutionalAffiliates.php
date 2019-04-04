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
     * @param Credential $credential
     *
     * @return Response
     */
    public function list(Credential $credential) : Response
    {
        $this->httpRequest->createHeaderAuthorizationBearerToken($credential->getApiKey(), $credential->getAccessToken());

        $result = $this->httpRequest->get(self::ENDPOINT);

        return $result;
    }
}