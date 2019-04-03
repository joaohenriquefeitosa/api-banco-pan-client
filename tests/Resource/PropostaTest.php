<?php


use Pan\Auth\Credencial;
use Pan\Resource\Proposta;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class PropostaTest extends TestCase
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

    public function testSimularShouldReturnResultObject()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $proposta = new Proposta();
        $proposta->setHttpRequest($this->httpRequest);

        $credencial = new Credencial();
        $credencial->setApiKey('api-key');
        $credencial->setAccessToken('token');

        $result = $proposta->simular($credencial, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']);

        $this->assertInstanceOf(Response::class, $result);
    }
}
