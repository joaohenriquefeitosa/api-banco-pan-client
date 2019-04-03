<?php


use Pan\Resource\ReleaseMedium;
use PHPUnit\Framework\TestCase;

class ReleaseMediumTest extends TestCase
{
    /**
     * @var ReleaseMedium
     */
    private $releaseMedium;

    public function setUp()
    {
        $this->releaseMedium = new ReleaseMedium();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }
    public function testReleaseMediumListingSuccessfully()
    {
        $result = $this->releaseMedium->list('', '', '', '','', '');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($content);
    }
}
