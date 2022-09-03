<?php

use UtxoOne\TwitterUltimatePhp\Client\TweetLookup;
use UtxoOne\TwitterUltimatePhp\Models\Tweet;
use UtxoOne\TwitterUltimatePhp\Models\Tweets;

class TweetLookupTest extends ClientTest
{
    public function testGetTweet(): void
    {
        $client = new TweetLookup(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getTweet('1565628118001455105');

        $this->assertInstanceOf(Tweet::class, $response);
        $this->assertSame('1565628118001455105', $response->getId());
        $this->assertNotNull($response->getCreatedAt());
        $this->assertNotNull($response->getText());
        $this->assertNotNull($response->getAuthorId());
        $this->assertNotNull($response->getConversationId());
        $this->assertNotNull($response->getPublicMetrics());

    }

    public function testGetTweets(): void
    {
        $client = new TweetLookup(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getTweets(['1565628118001455105', '1565999511536914433']);

        $this->assertInstanceOf(Tweets::class, $response);
        $this->assertSame('1565628118001455105', $response->all()[0]->getId());
        $this->assertSame('1565999511536914433', $response->all()[1]->getId());
    }
}