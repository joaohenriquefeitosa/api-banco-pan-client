<?php


use Pan\Auth\Credential;
use Pan\Resource\InstitutionalBodies;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class InstitutionBodiesTest extends TestCase
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

        $institutionalBodies = new InstitutionalBodies();
        $institutionalBodies->setHttpRequest($this->httpRequest);

        $credential = new Credential('api-key');
        $credential->setAccessToken('token');

        $result = $institutionalBodies->list($credential, ['']);

        $this->assertInstanceOf(Response::class, $result);
    }
}