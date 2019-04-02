<?php

use Pan\Resource\Covenants;
use PHPUnit\Framework\TestCase;

class CovenantsTest extends TestCase
{
    /**
     * @var Covenants
     */
    private $covenants;

    public function setUp()
    {
        $this->covenants = new Covenants();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    public function testCovenantsListingSuccessfully()
    {
        $result = $this->covenants->list('', '', '002711');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($content);
    }
}
