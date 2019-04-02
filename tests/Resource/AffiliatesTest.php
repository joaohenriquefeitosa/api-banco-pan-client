<?php


use Pan\Resource\Affiliates;
use PHPUnit\Framework\TestCase;

class AffiliatesTest extends TestCase
{
    /**
     * @var Affiliates
     */
    private $affiliates;

    public function setUp()
    {
        $this->affiliates = new Affiliates();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }
    public function testAffiliatesListingSuccessfully()
    {
        $result = $this->affiliates->list('', '');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($content);
    }
}
