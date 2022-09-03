<?php

use UtxoOne\TwitterUltimatePhp\Client\Follows;
use UtxoOne\TwitterUltimatePhp\Models\Users;

final class FollowsTest extends ClientTest
{
    public function testGetFollowers(): void
    {
        $client = new Follows(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getFollowers($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }

    public function testGetFollowing(): void
    {
        $client = new Follows(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getFollowing($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }
}