<?php


use Pan\Auth\Autenticacao;
use PHPUnit\Framework\TestCase;

class AutenticacaoTest extends TestCase
{
    /**
     * @var Autenticacao
     */
    private $autenticacao;

    /**
     * @throws Exception
     */
    public function setUp()
    {

        $this->autenticacao = new Autenticacao();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    public function testAuthenticationSuccessfully() {
        $result = $this->autenticacao->autenticar('', '', '');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertArrayHasKey("access_token", $content);
        $this->assertArrayHasKey("data_hora_expiracao", $content);
    }
}
