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

    /**
     * @var array
     */
    private $config;

    public function setUp()
    {
        $this->httpRequest = $this
            ->getMockBuilder(\Pan\Http\HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequest
            ->method('post')
            ->willReturn(new Response());

        $this->config = [
            'basePathApi' => '',
            'credential' => new Credential('apiKey')
        ];
        $this->config['credential']->setUsername('username');
        $this->config['credential']->setPassword('password');
    }

    public function testAuthenticationSuccessfully() {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $authentication = new Authentication();
        $authentication->setHttpRequest($this->httpRequest);

        $result = $authentication->authenticate($this->config, ['', '']);

        $this->assertInstanceOf(Response::class, $result);
    }
}
