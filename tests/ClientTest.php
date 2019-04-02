<?php

use Pan\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @throws Exception
     */
    public function setUp()
    {
        $this->client = new Client('l70459e7eac7fd4b2aaf6aebad9aaa41f6');

        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    }

    public function testAuthenticationSuccessfully() {
        $result = $this->client->authenticate('01234567890_112358', 'Senha@1321');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertArrayHasKey("access_token", $content);
        $this->assertArrayHasKey("data_hora_expiracao", $content);
    }
}
