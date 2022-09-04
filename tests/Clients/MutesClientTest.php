<?php

use UtxoOne\TwitterUltimatePhp\Clients\FollowsClient;
use UtxoOne\TwitterUltimatePhp\Clients\MutesClient;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class MutesClientTest extends BaseClientTest
{
    /** @group getMutes */
    public function testGetMutes(): void
    {
        $this->markTestIncomplete('Unauthorized Authentication');
        $client = new MutesClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getMutes($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }
}