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

        $institutionalAffiliate = new InstitutionalAffiliates();
        $institutionalAffiliate->setHttpRequest($this->httpRequest);

        $credential = new Credential('api-key');
        $credential->setAccessToken('token');

        $result = $institutionalAffiliate->list($credential, '');

        $this->assertInstanceOf(Response::class, $result);
    }
}
