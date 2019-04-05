<?php


use Pan\Auth\Credential;
use Pan\Resource\InstitutionalAffiliates;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class InstitutionalAffiliateTest extends TestCase
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

        $institutionalAffiliate = new InstitutionalAffiliates();
        $institutionalAffiliate->setHttpRequest($this->httpRequest);

        $result = $institutionalAffiliate->list($this->config, '');

        $this->assertInstanceOf(Response::class, $result);
    }
}
