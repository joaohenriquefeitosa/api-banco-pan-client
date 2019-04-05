<?php

use Pan\Auth\Credential;
use Pan\Resource\Covenants;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class CovenantsTest extends TestCase
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
            ->willReturn(new Response());

        $this->config = [
            'basePathApi' => '',
            'credential' => new Credential('apiKey')
        ];
        $this->config['credential']->setAccessToken('token');
    }

    public function testListShouldReturnResultObject()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $covenants = new Covenants();
        $covenants->setHttpRequest($this->httpRequest);

        $result = $covenants->list($this->config, ['']);

        $this->assertInstanceOf(Response::class, $result);
    }
}
