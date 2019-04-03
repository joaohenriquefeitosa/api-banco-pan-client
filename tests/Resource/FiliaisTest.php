<?php


use Pan\Resource\Filiais;
use PHPUnit\Framework\TestCase;

class FiliaisTest extends TestCase
{
    /**
     * @var Filiais
     */
    private $filiais;

    public function setUp()
    {
        $this->filiais = new Filiais();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }
    public function testAffiliatesListingSuccessfully()
    {
        $result = $this->filiais->listar('', '');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($content);
    }
}
