<?php

use UtxoOne\TwitterUltimatePhp\Clients\UserClient;
use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\User;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class UserClienTest extends BaseClientTest
{
    /** @group getUserByUsername */
    public function testGetUserByUsername(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserByUsername('utxoone');

        $this->assertInstanceOf(User::class, $response);
        $this->assertSame('utxoONE', $response->getUsername());
    }

    /** @group getUserById */
    public function testGetUserById(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserById($client->getUserByUsername('utxoone')->getId());

        $this->assertInstanceOf(User::class, $response);
        $this->assertSame('utxoONE', $response->getUsername());
        $this->assertFalse($response->isProtected());
        $this->assertFalse($response->isVerified());
        $this->assertSame('2022-08-14T21:32:08.000Z', $response->getCreatedAt());

    }

    /** @group getLikedTweets */
    public function testGetLikedTweets(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getLikedTweets($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Tweets::class, $response);
        $this->assertAllTweetFieldsAreSet($response);
    }

    /** @group getFollowers */
    public function testGetFollowers(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getFollowers($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }

    /** @group getFollowing */
    public function testGetFollowing(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getFollowing($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }
}