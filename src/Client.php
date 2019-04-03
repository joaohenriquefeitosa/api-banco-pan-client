<?php

namespace Pan;

use Exception;
use http\Exception\InvalidArgumentException;
use Pan\Auth\Autenticacao;
use Pan\Auth\Credencial;
use Pan\Resource\Convenios;
use Pan\Resource\Filiais;
use Pan\Resource\MeioLiberacao;
use Pan\Resource\Proposta;
use Pan\Resource\Usuarios;

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
     * @var Usuarios
     */
    private $usuarios;

    /**
     * @var Proposta
     */
    private $proposta;

    /**
     * @var Credencial
     */
    private $credencial;

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
        $this->usuarios = new Usuarios();
        $this->proposta = new Proposta();
        $this->credencial = new Credencial();

        $this->credencial->setApiKey($apiKey);
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function autenticacao(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 2) {
            throw new InvalidArgumentException("Missing Parameters");
        }

        $this->credencial->setUsername($args[0]);
        $this->credencial->setPassword($args[1]);

        $result = $this->autenticacao->autenticar($this->credencial, $args);

        $token = $result->getContent()["access_token"];

        $this->credencial->setAccessToken($token);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function convenios(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 1) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->convenios->listar($this->credencial, $args);

        return $result;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function filiais(): Response
    {
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->filiais->listar($this->credencial);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function meioLiberacao(...$args): Response
    {
        if (empty($args) or sizeof($args) != 4) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->meioLiberacao->listar($this->credencial, $args);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function usuarios(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 1) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->usuarios->listar($this->credencial, $args);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function simularProposta(...$args)
    {
        if (empty($args) or sizeof($args) != 16) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        return $this->proposta->simular($this->credencial, $args);
    }

    /**
     * @return bool
     */
    private function isAuthenticated()
    {
        return !empty($this->credencial) and !empty($this->credencial->getAccessToken());
    }

    /**
     * @param Credencial $credencial
     */
    public function setCredencial(Credencial $credencial): void
    {
        $this->credencial = $credencial;
    }

    /**
     * @param Autenticacao $autenticacao
     */
    public function setAutenticacao(Autenticacao $autenticacao): void
    {
        $this->autenticacao = $autenticacao;
    }

    /**
     * @param Convenios $convenios
     */
    public function setConvenios(Convenios $convenios): void
    {
        $this->convenios = $convenios;
    }

    /**
     * @param Filiais $filiais
     */
    public function setFiliais(Filiais $filiais): void
    {
        $this->filiais = $filiais;
    }

    /**
     * @param MeioLiberacao $meioLiberacao
     */
    public function setMeioLiberacao(MeioLiberacao $meioLiberacao): void
    {
        $this->meioLiberacao = $meioLiberacao;
    }

    /**
     * @param Usuarios $usuarios
     */
    public function setUsuarios(Usuarios $usuarios): void
    {
        $this->usuarios = $usuarios;
    }

    /**
     * @param Proposta $proposta
     */
    public function setProposta(Proposta $proposta): void
    {
        $this->proposta = $proposta;
    }
}