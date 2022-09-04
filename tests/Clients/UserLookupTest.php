<?php 

use UtxoOne\TwitterUltimatePhp\Clients\UserLookupClient;
use UtxoOne\TwitterUltimatePhp\Models\User;

class UserLookupTest extends BaseClientTest
{
    public function testGetUserByUsername(): void
    {
        $client = new UserLookupClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserByUsername('utxoone');

        $this->assertInstanceOf(User::class, $response);
        $this->assertSame('utxoONE', $response->getUsername());
    }

    public function testGetUserById(): void
    {
        $client = new UserLookupClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserById($client->getUserByUsername('utxoone')->getId());

        $this->assertInstanceOf(User::class, $response);
        $this->assertSame('utxoONE', $response->getUsername());
        $this->assertFalse($response->isProtected());
        $this->assertFalse($response->isVerified());
        $this->assertSame('2022-08-14T21:32:08.000Z', $response->getCreatedAt());

    }
}