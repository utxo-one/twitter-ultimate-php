<?php

use UtxoOne\TwitterUltimatePhp\Clients\ListClient;
use UtxoOne\TwitterUltimatePhp\Models\TwitterList;

class ListClientTest extends BaseClientTest
{
    public function testGetList(): void
    {
        $client = new ListClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getList('1546029449191342080');

        $this->assertInstanceOf(TwitterList::class, $response);
        $this->assertSame('1546029449191342080', $response->getId());
    }
}