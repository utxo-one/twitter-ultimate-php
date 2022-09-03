<?php 

use PHPUnit\Framework\TestCase;
use UtxoOne\TwitterUltimatePhp\Client\Client;
use UtxoOne\TwitterUltimatePhp\Models\TwitterResponse;

final class ClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $dotenv = \Dotenv\Dotenv::createImmutable('./');
        $dotenv->load();
    }

    public function testGet(): void
    {
        $client = new Client(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->get('users/by/username/utxoone', [
            'user.fields' => 'created_at',
        ]);

        $this->assertInstanceOf(TwitterResponse::class, $response);
        $this->assertArrayHasKey('id', $response->getData());
    }
}