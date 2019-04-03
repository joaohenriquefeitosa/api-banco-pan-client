<?php


use Pan\Auth\Autenticacao;
use Pan\Auth\Credencial;
use Pan\Client;
use Pan\Resource\Convenios;
use Pan\Resource\Filiais;
use Pan\Resource\MeioLiberacao;
use Pan\Resource\Proposta;
use Pan\Resource\Usuarios;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $this->client = new Client('Api-Key');

        $credencial = new Credencial();
        $credencial->setApiKey('api-key');
        $credencial->setUsername('username');
        $credencial->setPassword('password');
        $credencial->setAccessToken('token');

        $this->client->setCredencial($credencial);
    }

    public function testAutenticacaoShouldReturnResultObject()
    {
        $autenticacao = $this
            ->getMockBuilder(Autenticacao::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = new Response();
        $response->setContent([
           'access_token' => 'token'
        ]);

        $autenticacao
            ->method('autenticar')
            ->willReturn($response);

        $this->client->setAutenticacao($autenticacao);
        $result = $this->client->autenticacao('','');

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testConveniosShouldReturnResultObject()
    {
        $convenios = $this
            ->getMockBuilder(Convenios::class)
            ->disableOriginalConstructor()
            ->getMock();

        $convenios
            ->method('listar')
            ->willReturn(new Response());

        $this->client->setConvenios($convenios);
        $result = $this->client->convenios('');

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testFiliaisShouldReturnResultObject()
    {
        $filiais = $this
            ->getMockBuilder(Filiais::class)
            ->disableOriginalConstructor()
            ->getMock();

        $filiais
            ->method('listar')
            ->willReturn(new Response());

        $this->client->setFiliais($filiais);
        $result = $this->client->filiais();

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testMeioLiberacaoShouldReturnResultObject()
    {
        $meioLiberacao = $this
            ->getMockBuilder(MeioLiberacao::class)
            ->disableOriginalConstructor()
            ->getMock();

        $meioLiberacao
            ->method('listar')
            ->willReturn(new Response());

        $this->client->setMeioLiberacao($meioLiberacao);
        $result = $this->client->meioLiberacao('','','','');

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testUsuariosShouldReturnResultObject()
    {
        $usuarios = $this
            ->getMockBuilder(Usuarios::class)
            ->disableOriginalConstructor()
            ->getMock();

        $usuarios
            ->method('listar')
            ->willReturn(new Response());

        $this->client->setUsuarios($usuarios);
        $result = $this->client->usuarios('');

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testSimularPropostaShouldReturnResultObject()
    {
        $proposta = $this
            ->getMockBuilder(Proposta::class)
            ->disableOriginalConstructor()
            ->getMock();

        $proposta
            ->method('simular')
            ->willReturn(new Response());

        $this->client->setProposta($proposta);
        $result = $this->client->simularProposta('','','','','','','','','','','','','','','','');

        $this->assertInstanceOf(Response::class, $result);
    }
}
