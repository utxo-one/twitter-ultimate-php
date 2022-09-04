<?php

use UtxoOne\TwitterUltimatePhp\Clients\ListClient;
use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\TwitterList;
use UtxoOne\TwitterUltimatePhp\Models\TwitterLists;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class ListClientTest extends BaseClientTest
{
    public function testGetList(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getList('1546029449191342080');

        $this->assertInstanceOf(TwitterList::class, $response);
        $this->assertSame('1546029449191342080', $response->getId());
    }

    public function testGetUserOwnedLists(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserOwnedLists($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(TwitterLists::class, $response);
    }

    public function testGetListTweets(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getListTweets('1566433477792235520');

        $this->assertInstanceOf(Tweets::class, $response);
    }

    public function testGetListMembers(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getListMembers('1566433477792235520');

        $this->assertInstanceOf(Users::class, $response);
    }

    public function testGetUserMemberships(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserMemberships($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(TwitterLists::class, $response);
    }

    /** @group getListFollowers */
    public function testGetListFollowers(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getListFollowers('1566433477792235520');

        $this->assertInstanceOf(Users::class, $response);
    }

    /** @group getUserFollowedLists */
    public function testGetUserFollowedLists(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserFollowedLists($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(TwitterLists::class, $response);
    }

    /** @group getUserPinnedLists */
    public function testGetUserPinnedLists(): void
    {
        $this->markTestIncomplete('requires higher authentication');
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getUserPinnedLists($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(TwitterLists::class, $response);
    }
}