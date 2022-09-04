<?php

use UtxoOne\TwitterUltimatePhp\Clients\FollowsClient;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class FollowsClientTest extends BaseClientTest
{
    public function testGetFollowers(): void
    {
        $client = new FollowsClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getFollowers($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }

    public function testGetFollowing(): void
    {
        $client = new FollowsClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getFollowing($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }
}