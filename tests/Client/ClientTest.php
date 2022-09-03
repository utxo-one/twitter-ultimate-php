<?php 

use PHPUnit\Framework\TestCase;
use UtxoOne\TwitterUltimatePhp\Client\Client;

class ClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $dotenv = \Dotenv\Dotenv::createImmutable('./');
        $dotenv->load();
    }

    public function testClientInit()
    {
        $client = new Client();

        $this->assertInstanceOf(Client::class, $client);
    }
}