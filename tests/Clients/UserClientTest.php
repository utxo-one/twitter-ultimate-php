<?php

use UtxoOne\TwitterUltimatePhp\Clients\UserClient;
use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\User;
use UtxoOne\TwitterUltimatePhp\Models\UserPublicMetrics;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class UserClientTest extends BaseClientTest
{
    /** @group getUserByUsername */
    public function testGetUserByUsername(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserByUsername('utxo_one');

        $this->assertInstanceOf(User::class, $response);
        $this->assertSame('utxo_one', $response->getUsername());
    }

    /** @group getUserById */
    public function testGetUserById(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserById($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(User::class, $response);
        $this->assertSame('utxo_one', $response->getUsername());
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

    /** @group follow */
    public function testFollow(): void
    {
        $client = new UserClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $response = $client->follow($_ENV['TWITTER_ADMIN_USER_ID'], '12');

        //die(var_dump($response));

        $this->assertArrayHasKey('following', $response->getData());
    }

    /** @group unfollow */
    public function testUnfollow(): void
    {
        $client = new UserClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $client->follow($_ENV['TWITTER_ADMIN_USER_ID'], '12');
        $response = $client->unfollow($_ENV['TWITTER_ADMIN_USER_ID'], '12');

        $this->assertArrayHasKey('following', $response->getData());
    }

    /** @group block */
    public function testBlock(): void
    {
        $client = new UserClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $response = $client->block($_ENV['TWITTER_ADMIN_USER_ID'], '12');

        $this->assertArrayHasKey('blocking', $response->getData());
    }

    /** @group unblock */
    public function testUnblock(): void
    {
        $client = new UserClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $client->block($_ENV['TWITTER_ADMIN_USER_ID'], '12');
        $response = $client->unblock($_ENV['TWITTER_ADMIN_USER_ID'], '12');

        $this->assertArrayHasKey('blocking', $response->getData());
    }

    /** @group getBlocks */
    public function testGetBlocks(): void
    {
        $this->markTestIncomplete('Unauthorized Authentication');
        $client = new UserClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
            bearerToken: $_ENV['TWITTER_BEARER_TOKEN'],
        );

        $response = $client->getBlocks($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }

    /** @group mute */
    public function testMute(): void
    {
        $client = new UserClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $response = $client->mute($_ENV['TWITTER_ADMIN_USER_ID'], '12');

        $this->assertArrayHasKey('muting', $response->getData());
    }

    /** @group unmute */
    public function testUnmute(): void
    {
        $client = new UserClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $client->mute($_ENV['TWITTER_ADMIN_USER_ID'], '12');
        $response = $client->unmute($_ENV['TWITTER_ADMIN_USER_ID'], '12');

        $this->assertArrayHasKey('muting', $response->getData());
    }

    /** @group getPublicMetrics */
    public function testGetPublicMetrics(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $publicMetrics = $client->getUserById($_ENV['TWITTER_ADMIN_USER_ID'])->getPublicMetrics();

        $this->assertInstanceOf(UserPublicMetrics::class, $publicMetrics);
        $this->assertIsInt($publicMetrics->getFollowersCount());
        $this->assertIsInt($publicMetrics->getFollowingCount());
        $this->assertIsInt($publicMetrics->getTweetCount());
        $this->assertIsInt($publicMetrics->getListedCount());
    }

    /** @group getPaginationToken */
    public function testGetPaginationToken(): void
    {
        $client = new UserClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getFollowers(
            id: $_ENV['TWITTER_ADMIN_USER_ID'],
            maxResults: 3
        );

        $this->assertIsString($response->getPaginationToken());
    }
}
