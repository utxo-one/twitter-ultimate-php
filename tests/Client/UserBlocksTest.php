<?php

use PHPUnit\Framework\TestCase;
use UtxoOne\TwitterUltimatePhp\Client\Blocks;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class UserBlocksTest extends ClientTest
{
    public function testGetBlocks(): void
    {
        $this->markTestIncomplete('Unsupported Authentication');
        $client = new Blocks(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getBlocks($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }
}