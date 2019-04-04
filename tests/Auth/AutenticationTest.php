<?php

use Pan\Auth\Authentication;
use Pan\Auth\Credential;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class AutenticationTest extends TestCase
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

        $authentication = new Authentication();
        $authentication->setHttpRequest($this->httpRequest);

        $credential = new Credential('api-key');
        $credential->setUsername('username');
        $credential->setPassword('password');

        $result = $authentication->authenticate($credential, ['', '']);

        $this->assertInstanceOf(Response::class, $result);
    }
}
