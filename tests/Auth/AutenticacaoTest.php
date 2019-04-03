<?php


use Pan\Auth\Autenticacao;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class AutenticacaoTest extends TestCase
{
    /**
     * @var \Pan\Http\HttpRequest | \PHPUnit\Framework\MockObject\MockObject
     */
    private $httpRequest;

    public function setUp()
    {
        $this->httpRequest = $this
            ->getMockBuilder(\Pan\Http\HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequest
            ->method('post')
            ->willReturn(new Response());
    }

    public function testAuthenticationSuccessfully() {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $autenticacao = new Autenticacao();
        $autenticacao->setHttpRequest($this->httpRequest);

        $result = $autenticacao->autenticar("", "", "");

        $this->assertInstanceOf(Response::class, $result);
    }
}
