<?php

use Pan\Resource\Covenants;
use PHPUnit\Framework\TestCase;

class CovenantsTest extends TestCase
{
    /**
     * @var Covenants
     */
    private $covenants;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $accessToken;

    public function setUp()
    {
        $this->covenants = new Covenants();
        $this->apiKey = 'l70459e7eac7fd4b2aaf6aebad9aaa41f6';
        $this->accessToken = 'ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnpkV0lpT2lJeE1qTTBOVFkzT0Rrd0
            lpd2libUZ0WlNJNklrcHZhRzRnUkc5bElpd2lhV0YwSWpveE5URTJNak01TURJeWZRLlNmbEt4d1JKU01lS0tGMlFUNGZ3cE1lSmYzNlBPazZ5SlZfYWRRc3N3NWM=';

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    public function testCovenantsListingSuccessfully()
    {
        $result = $this->covenants->list($this->apiKey, $this->accessToken, '002711');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($content);
    }
}
