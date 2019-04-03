<?php

use Pan\Resource\Usuarios;
use PHPUnit\Framework\TestCase;

class UsuariosTest extends TestCase
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
            ->willReturn(new \Pan\Response());
    }

    public function testListShouldReturnResultObject()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $users = new Usuarios();
        $users->setHttpRequest($this->httpRequest);

        $result = $users->listar("", "", "");

        $this->assertInstanceOf(\Pan\Response::class, $result);
    }
}