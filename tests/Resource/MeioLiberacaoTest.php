<?php


use Pan\Resource\MeioLiberacao;
use PHPUnit\Framework\TestCase;

class MeioLiberacaoTest extends TestCase
{
    /**
     * @var MeioLiberacao
     */
    private $meioLiberacao;

    public function setUp()
    {
        $this->meioLiberacao = new MeioLiberacao();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }
    public function testReleaseMediumListingSuccessfully()
    {
        $result = $this->meioLiberacao->listar('', '', '', '','', '');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertIsArray($content);
    }
}
