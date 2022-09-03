<?php

use PHPUnit\Framework\TestCase;
use UtxoOne\TwitterUltimatePhp\Client\Blocks;
use UtxoOne\TwitterUltimatePhp\Models\Users;

final class BlocksTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $dotenv = \Dotenv\Dotenv::createImmutable('./');
        $dotenv->load();
    }
    
    public function testGetBlocks(): void
    {
        $client = new Blocks(bearerToken: $_ENV['TWITTER_BEARER_TOKEN']);

        $response = $client->getBlocks($_ENV['TWITTER_ADMIN_USER_ID']);

        $this->assertInstanceOf(Users::class, $response);
    }
}