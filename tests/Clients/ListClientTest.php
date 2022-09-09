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

        $response = $client->getListTweets('1546029449191342080');

        $this->assertInstanceOf(Tweets::class, $response);
    }

    public function testGetListMembers(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getListMembers('1546029449191342080');

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

        $response = $client->getListFollowers('1546029449191342080');
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

    /** @group createList */
    public function testCreateList(): void
    {
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $response = $client->createList(
            name: 'test list',
            description: 'test list description',
            private: false,
        );

        $this->assertInstanceOf(TwitterList::class, $response);

        $client->deleteList($response->getId());
    }

    /** @group updateList */
    public function testUpdateList(): void
    {
        $this->markTestIncomplete('requires higher authentication');
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $response = $client->updateList(
            id: '1567321249289756672',
            name: 'test list',
            description: 'test list description',
            private: false,
        );

        $this->assertInstanceOf(TwitterList::class, $response);
    }

    /** @group deleteList */
    public function testDeleteList(): void
    {
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $newListId = $client->createList(
            name: 'test list',
            description: 'test list description',
            private: false,
        )->getId();

        $response = $client->deleteList($newListId);

        $this->assertTrue($response);
    }

    /** @group addListMember */
    public function testAddListMember(): void
    {
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $list = $client->createList(
            name: 'test list',
            description: 'test list description',
            private: false,
        );

        $response = $client->addListMember(
            id: $list->getId(),
            userId: 12,
        );

        $this->assertTrue($response);

        $client->deleteList($list->getId());
    }

    /** @group removeListMember */
    public function testRemoveListMember(): void
    {
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $list = $client->createList(
            name: 'test list',
            description: 'test list description',
            private: false,
        );

        $client->addListMember(
            id: $list->getId(),
            userId: 12,
        );

        $response = $client->removeListMember(
            id: $list->getId(),
            userId: 12,
        );

        $this->assertTrue($response);

        $client->deleteList($list->getId());
    }

    /** @group followList */
    public function testFollowList(): void
    {
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $list = $client->createList(
            name: 'test list',
            description: 'test list description',
            private: false,
        );

        $response = $client->followList(
            listId: $list->getId(),
            userId: $_ENV['TWITTER_ADMIN_USER_ID'],
        );

        $this->assertTrue($response);

        $client->deleteList($list->getId());
    }

    /** @group unfollowList */
    public function testUnfollowList(): void
    {
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $list = $client->createList(
            name: 'test list',
            description: 'test list description',
            private: false,
        );

        $client->followList(
            listId: $list->getId(),
            userId: $_ENV['TWITTER_ADMIN_USER_ID'],
        );

        $response = $client->unfollowList(
            listId: $list->getId(),
            userId: $_ENV['TWITTER_ADMIN_USER_ID'],
        );

        $this->assertTrue($response);

        $client->deleteList($list->getId());
    }

    /** @group pinList */
    public function testPinList(): void
    {
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $list = $client->createList(
            name: 'test list',
            description: 'test list description',
            private: false,
        );

        $response = $client->pinList(
            userId: $_ENV['TWITTER_ADMIN_USER_ID'],
            listId: $list->getId(),
        );

        $this->assertTrue($response);

        $client->deleteList($list->getId());
    }

    /** @group unpinList */
    public function testUnpinList(): void
    {
        $client = new ListClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $list = $client->createList(
            name: 'test list',
            description: 'test list description',
            private: false,
        );

        $client->pinList(
            userId: $_ENV['TWITTER_ADMIN_USER_ID'],
            listId: $list->getId(),
        );

        $response = $client->unpinList(
            userId: $_ENV['TWITTER_ADMIN_USER_ID'],
            listId: $list->getId(),
        );

        $this->assertTrue($response);

        $client->deleteList($list->getId());
    }

        /** @group deleteAllLists */
        public function testDeleteAllLists(): void
        {
            $authClient = new ListClient(
                apiKey: $_ENV['TWITTER_API_KEY'], 
                apiSecret: $_ENV['TWITTER_API_SECRET'], 
                accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
                accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
            );
    
            $getClient = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);
    
            $response = $getClient->getUserOwnedLists($_ENV['TWITTER_ADMIN_USER_ID']);
    
            foreach ($response->all() as $list) {
                $authClient->deleteList($list->getId());
            }
    
            $this->assertTrue(true);
        }


}