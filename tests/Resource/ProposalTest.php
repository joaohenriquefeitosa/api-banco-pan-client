<?php


use Pan\Auth\Credential;
use Pan\Resource\Proposal;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class ProposalTest extends TestCase
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
        $this->config['credential']->setAccessToken('token');
    }

    public function testSimularShouldReturnResultObject()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $proposal = new Proposal();
        $proposal->setHttpRequest($this->httpRequest);

        $result = $proposal->simulate($this->config, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']);

        $this->assertInstanceOf(Response::class, $result);
    }
}
