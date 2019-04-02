<?php

namespace Pan;

use Exception;
use http\Exception\InvalidArgumentException;
use Pan\Auth\BasicAuth;
use Pan\Resource\Affiliates;
use Pan\Resource\Covenants;
use Pan\Resource\ReleaseMedium;

/**
 * Client
 */
class Client
{
    /**
     * @var BasicAuth
     */
    private $basicAuth;

    /**
     * @var Covenants
     */
    private $covenants;

    /**
     * @var Affiliates
     */
    private $affiliates;

    /**
     * @var ReleaseMedium
     */
    private $releaseMedium;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Client constructor.
     *
     * @param string $apiKey
     *
     * @throws \Exception
     */
    public function __construct(string $apiKey)
    {
        $this->basicAuth = new BasicAuth();
        $this->covenants = new Covenants();
        $this->affiliates = new Affiliates();
        $this->releaseMedium = new ReleaseMedium();

        $this->apiKey = $apiKey;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return Response
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    public function autenticacao(string $username, string $password) : Response
    {
        if (empty($username) or empty($password) or empty($this->apiKey)) {
            throw new InvalidArgumentException("Missing Parameters");
        }

        $result = $this->basicAuth->authenticate($username, $password, $this->apiKey);

        $this->accessToken = $result->getContent()["access_token"];

        return $result;
    }

    /**
     * @param string $promo_code
     *
     * @return Response
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function convenios(string $promo_code) : Response
    {
        if (empty($promo_code)) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (empty($this->accessToken) or empty($this->apiKey)) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->covenants->list($this->apiKey, $this->accessToken, $promo_code);

        return $result;
    }

    public function filiais(): Response
    {
        if (empty($this->accessToken) or empty($this->apiKey)) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->affiliates->list($this->apiKey, $this->accessToken);

        return $result;
    }

    /**
     * @param string $codigo_convenio
     * @param string $tipo_operacao
     * @param string $cep_cliente
     * @param string $valor_cliente
     *
     * @return Response
     * @throws Exception
     */
    public function meio_liberacao(string $codigo_convenio, string $tipo_operacao, string $cep_cliente, string $valor_cliente): Response
    {
        if (empty($this->accessToken) or empty($this->apiKey)) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->releaseMedium
            ->list(
                $this->apiKey,
                $this->accessToken,
                $codigo_convenio,
                $tipo_operacao,
                $cep_cliente,
                $valor_cliente
            );

        return $result;
    }
}
