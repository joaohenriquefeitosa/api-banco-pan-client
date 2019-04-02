<?php


use Pan\Auth\BasicAuth;
use PHPUnit\Framework\TestCase;

class BasicAuthTest extends TestCase
{
    /**
     * @var BasicAuth
     */
    private $basicAuth;

    /**
     * @throws Exception
     */
    public function setUp()
    {

        $this->basicAuth = new BasicAuth();

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    public function testAuthenticationSuccessfully() {
        $result = $this->basicAuth->authenticate('', '', '');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertArrayHasKey("access_token", $content);
        $this->assertArrayHasKey("data_hora_expiracao", $content);
    }
}
