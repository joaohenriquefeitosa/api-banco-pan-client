<?php


use Pan\Resource\Filiais;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class FiliaisTest extends TestCase
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

        $filiais = new Filiais();
        $filiais->setHttpRequest($this->httpRequest);

        $result = $filiais->listar("", "");

        $this->assertInstanceOf(Response::class, $result);
    }
}
