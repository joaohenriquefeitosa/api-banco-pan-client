<?php

use Pan\Auth\Credential;
use Pan\Resource\Users;
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
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
            ->method('get')
            ->willReturn(new \Pan\Response());

        $this->config = [
            'basePathApi' => '',
            'credential' => new Credential('apiKey')
        ];
        $this->config['credential']->setUsername('username');
        $this->config['credential']->setPassword('password');
    }

    public function testListShouldReturnResultObject()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $users = new Users();
        $users->setHttpRequest($this->httpRequest);

        $result = $users->list($this->config, ['']);

        $this->assertInstanceOf(\Pan\Response::class, $result);
    }
}