<?php


use Pan\Resource\Organs;
use PHPUnit\Framework\TestCase;

class OrgansTest extends TestCase
{
    /**
     * @var Organs
     */
    private $organs;

    public function setUp()
    {
        $this->organs = new Organs();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    public function testCovenantsListingSuccessfully()
    {
        $result = $this->organs->list('', '', '');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($content);
    }
}
