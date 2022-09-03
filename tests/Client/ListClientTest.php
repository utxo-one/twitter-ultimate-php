<?php

use UtxoOne\TwitterUltimatePhp\Client\ListClient;
use UtxoOne\TwitterUltimatePhp\Client\TweetLookup;
use UtxoOne\TwitterUltimatePhp\Models\Tweet;
use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\TwitterList;

class ListClientTest extends ClientTest
{
    public function testGetList(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getList('1546029449191342080');

        $this->assertInstanceOf(TwitterList::class, $response);
        $this->assertSame('1546029449191342080', $response->getId());
    }
}