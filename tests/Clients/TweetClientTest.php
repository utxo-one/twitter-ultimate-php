<?php

use UtxoOne\TwitterUltimatePhp\Clients\TweetClient;
use UtxoOne\TwitterUltimatePhp\Models\Tweet;
use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class TweetClientTest extends BaseClientTest
{
    /** @group getTweet */
    public function testGetTweet(): void
    {
        $client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getTweet('1564986319981498368');

        $this->assertInstanceOf(Tweet::class, $response);
        $this->assertSame('1564986319981498368', $response->getId());
        $this->assertTweetFieldsAreSet($response);
    }

    /** @group getTweets */
    public function testGetTweets(): void
    {
        $client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getTweets(['1565628118001455105', '1565999511536914433']);

        $this->assertInstanceOf(Tweets::class, $response);
        $this->assertSame('1565628118001455105', $response->all()[0]->getId());
        $this->assertSame('1565999511536914433', $response->all()[1]->getId());
        $this->assertTweetFieldsAreSet($response->all()[0]);
        $this->assertTweetFieldsAreSet($response->all()[1]);
    }

    /** @group getTimeline */
    public function testGetTimeline(): void
    {
        $client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getTimeline('12', 10);

        $this->assertInstanceOf(Tweets::class, $response);
        $this->assertCount(10, $response->all());
        $this->assertTweetFieldsAreSet($response->all()[0]);
    }

    /** @group getReverseTimeline */
    public function testGetReverseTimeline(): void
    {
        $this->markTestIncomplete('Unsupported Authentication Type');
        
        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
            bearerToken: $_ENV['TWITTER_BEARER_TOKEN'],
        );

        $response = $client->getReverseTimeline($_ENV['TWITTER_ADMIN_USER_ID'], 10);

        $this->assertInstanceOf(Tweets::class, $response);
        $this->assertCount(10, $response->all());
        $this->assertTweetFieldsAreSet($response->all()[0]);
    }

    /** @group getMentionTimeline */
    public function testGetMentionTimeline(): void
    {
        $client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getMentionTimeline('12', 10);

        $this->assertInstanceOf(Tweets::class, $response);
        $this->assertCount(10, $response->all());
        $this->assertTweetFieldsAreSet($response->all()[0]);
    }

    /** @group getQuoteTweets */
    public function testGetQuoteTweets(): void
    {
        $client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getQuoteTweets('1564986319981498368');

        $this->assertInstanceOf(Tweets::class, $response);

        foreach ($response->all() as $tweet) {
            $this->assertTweetFieldsAreSet($tweet);
        }
    }

    /** @group getLikingUsers */
    public function testGetLikingUsers(): void
    {
        $client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getLikingUsers('1565628118001455105');

        $this->assertInstanceOf(Users::class, $response);
    }

    /** @group getRetweetedByUsers */
    public function testGetRetweetedByUsers(): void
    {
        $client = new TweetClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getRetweetedByUsers('1565628118001455105');

        $this->assertInstanceOf(Users::class, $response);
    }

    /** @group tweet */
    public function testTweet(): void
    {
        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $response = $client->tweet('Hello World!');

        $this->assertInstanceOf(Tweet::class, $response);

        $client->deleteTweet($response->getId());
    }

    /** @group deleteTweet */
    public function testDeleteTweet(): void
    {
        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $response = $client->tweet('Hello World!');

        $this->assertInstanceOf(Tweet::class, $response);

        $response = $client->deleteTweet($response->getId());

        $this->assertTrue($response);
    }

    /** @group likeTweet */
    public function testLikeTweet(): void
    {
        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $tweet = $client->tweet('Hello World!');

        $response = $client->likeTweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $this->assertTrue($response);

        $client->deleteTweet($tweet->getId());
    }

    /** @group unlikeTweet */
    public function testUnlikeTweet(): void
    {
        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $tweet = $client->tweet('Hello World!');

        $client->likeTweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $response = $client->unlikeTweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $this->assertTrue($response);

        $client->deleteTweet($tweet->getId());
    }

    /** @group retweet */
    public function testRetweet(): void
    {
        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $tweet = $client->tweet('Hello World!');

        $response = $client->retweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $this->assertTrue($response);

        $client->deleteTweet($tweet->getId());
    }

    /** @group unretweet */
    public function testUnretweet(): void
    {
        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $tweet = $client->tweet('Hello World!');

        $client->retweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $response = $client->unretweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $this->assertTrue($response);

        $client->deleteTweet($tweet->getId());
    }

    /** @group bookmarkTweet */
    public function testBookmarkTweet(): void
    {
        $this->markTestIncomplete('OAuth 2.0 user context required');

        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $tweet = $client->tweet('Hello World!');

        $response = $client->bookmarkTweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $this->assertTrue($response);

        $client->deleteTweet($tweet->getId());
    }

    /** @group unbookmarkTweet */
    public function testUnbookmarkTweet(): void
    {
        $this->markTestIncomplete('OAuth 2.0 user context required');

        $client = new TweetClient(
            apiKey: $_ENV['TWITTER_API_KEY'], 
            apiSecret: $_ENV['TWITTER_API_SECRET'], 
            accessToken: $_ENV['TWITTER_ACCESS_TOKEN'], 
            accessSecret: $_ENV['TWITTER_ACCESS_SECRET'],
        );

        $tweet = $client->tweet('Hello World!');

        $client->bookmarkTweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $response = $client->unbookmarkTweet($_ENV['TWITTER_ADMIN_USER_ID'], $tweet->getId());

        $this->assertTrue($response);

        $client->deleteTweet($tweet->getId());
    }
}