<?php


use Pan\Resource\MeioLiberacao;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class MeioLiberacaoTest extends TestCase
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
            ->method('get')
            ->willReturn(new Response());
    }

    public function testListShouldReturnResultObject()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $meioLiberacao = new MeioLiberacao();
        $meioLiberacao->setHttpRequest($this->httpRequest);

        $result = $meioLiberacao->listar("", "", "", "", "", "");

        $this->assertInstanceOf(Response::class, $result);
    }
}
