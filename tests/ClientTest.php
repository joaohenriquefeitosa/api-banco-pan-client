<?php

use Pan\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $client;

    /**
     * @throws Exception
     */
    public function setUp()
    {
        $this->client = new Client();
    }

    public function testAuthenticationSuccessfully() {
        $result = $this->client->authenticate('01234567890_112358', 'Senha@1321', 'api-key');
        $content = $result->getContent();

        $this->assertNotEmpty($result);
        $this->assertArrayHasKey("access_token", $content);
        $this->assertArrayHasKey("data_hora_expiracao", $content);
    }
}
