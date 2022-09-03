<?php 

use UtxoOne\TwitterUltimatePhp\Client\UserLookup;
use UtxoOne\TwitterUltimatePhp\Models\User;

final class UserLookupTest extends ClientTest
{
    public function testGetUserByUsername(): void
    {
        $client = new UserLookup(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserByUsername('utxoone');

        $this->assertInstanceOf(User::class, $response);
        $this->assertSame('utxoONE', $response->getUsername());
    }

    public function testGetUserById(): void
    {
        $client = new UserLookup(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserById($client->getUserByUsername('utxoone')->getId());

        $this->assertInstanceOf(User::class, $response);
        $this->assertSame('utxoONE', $response->getUsername());
    }
}