<?php

use UtxoOne\TwitterUltimatePhp\Clients\BlocksClient;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class UserBlocksTest extends BaseClientTest
{
    public function testGetBlocks(): void
    {
        $this->markTestIncomplete('Unsupported Authentication');
        $client = new BlocksClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getBlocks($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }
}