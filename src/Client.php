<?php

namespace Pan;

use Exception;
use http\Exception\InvalidArgumentException;
use Pan\Auth\Autenticacao;
use Pan\Resource\Filiais;
use Pan\Resource\Convenios;
use Pan\Resource\Orgaos;
use Pan\Resource\MeioLiberacao;

/**
 * Client
 */
class Client
{
    /**
     * @var Autenticacao
     */
    private $autenticacao;

    /**
     * @var Convenios
     */
    private $convenios;

    /**
     * @var Filiais
     */
    private $filiais;

    /**
     * @var MeioLiberacao
     */
    private $meioLiberacao;

    /**
     * @var Orgaos
     */
    private $orgaos;

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
        $this->autenticacao = new Autenticacao();
        $this->convenios = new Convenios();
        $this->filiais = new Filiais();
        $this->meioLiberacao = new MeioLiberacao();
        $this->orgaos = new Orgaos();

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

        $result = $this->autenticacao->autenticar($username, $password, $this->apiKey);

        $this->accessToken = $result->getContent()["access_token"];

        return $result;
    }

    /**
     * @param string $promoCode
     *
     * @return Response
     * @throws Exception
     */
    public function convenios(string $promoCode) : Response
    {
        if (empty($promoCode)) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (empty($this->accessToken) or empty($this->apiKey)) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->convenios->listar($this->apiKey, $this->accessToken, $promoCode);

        return $result;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function filiais(): Response
    {
        if (empty($this->accessToken) or empty($this->apiKey)) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->filiais->listar($this->apiKey, $this->accessToken);

        return $result;
    }

    /**
     * @param string $codigoConvenio
     * @param string $tipoOperacao
     * @param string $cepCliente
     * @param string $valorCliente
     *
     * @return Response
     * @throws Exception
     */
    public function meioLiberacao(string $codigoConvenio, string $tipoOperacao, string $cepCliente, string $valorCliente): Response
    {
        if (empty($this->accessToken) or empty($this->apiKey)) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->meioLiberacao
            ->listar(
                $this->apiKey,
                $this->accessToken,
                $codigoConvenio,
                $tipoOperacao,
                $cepCliente,
                $valorCliente
            );

        return $result;
    }

    /**
     * @param string $codigoConvenio
     *
     * @return Response
     * @throws Exception
     */
    public function orgaos(string $codigoConvenio) : Response
    {
        if (empty($codigoConvenio)) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (empty($this->accessToken) or empty($this->apiKey)) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->orgaos->listar($this->apiKey, $this->accessToken, $codigoConvenio);

        return $result;
    }
}
