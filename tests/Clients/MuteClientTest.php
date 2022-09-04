<?php

use UtxoOne\TwitterUltimatePhp\Clients\MuteClient;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class MuteClientTest extends BaseClientTest
{
    /** @group getMutes */
    public function testGetMutes(): void
    {
        $this->markTestIncomplete('Unauthorized Authentication');
        $client = new MuteClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getMutes($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }
}