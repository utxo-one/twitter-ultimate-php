<?php

use UtxoOne\TwitterUltimatePhp\Clients\SpaceClient;
use UtxoOne\TwitterUltimatePhp\Models\Space;

class SpaceClientTest extends BaseClientTest
{
    /** @group getSpace */
    public function testGetSpace(): void
    {
        $client = new SpaceClient(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getSpace('1PlKQpvqvDYxE');

        $this->assertInstanceOf(Space::class, $response);
    }
}