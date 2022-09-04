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

        $response = $client->getTweet('1565628118001455105');

        $this->assertInstanceOf(Tweet::class, $response);
        $this->assertSame('1565628118001455105', $response->getId());
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
}