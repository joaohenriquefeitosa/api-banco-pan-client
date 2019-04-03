<?php


use Pan\Resource\Orgaos;
use PHPUnit\Framework\TestCase;

class OrgaosTest extends TestCase
{
    /**
     * @var Orgaos
     */
    private $orgaos;

    public function setUp()
    {
        $this->orgaos = new Orgaos();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    public function testOrgansListingSuccessfully()
    {
        $result = $this->orgaos->listar('', '', '');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($content);
    }
}
