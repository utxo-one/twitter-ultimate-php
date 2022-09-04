<?php 

use PHPUnit\Framework\TestCase;
use UtxoOne\TwitterUltimatePhp\Client\Client;
use UtxoOne\TwitterUltimatePhp\Models\Tweet;

class BaseClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $dotenv = \Dotenv\Dotenv::createImmutable('./');
        $dotenv->load();
    }

    public function assertTweetFieldsAreSet(Tweet $tweet): void
    {
        $this->assertNotEmpty($tweet->getId());
        $this->assertNotEmpty($tweet->getText());
        $this->assertNotEmpty($tweet->getCreatedAt());
        $this->assertNotEmpty($tweet->getAuthorId());
        $this->assertNotEmpty($tweet->getLang());
        $this->assertNotEmpty($tweet->getSource());
        $this->assertNotEmpty($tweet->getPublicMetrics());
        $this->assertNotEmpty($tweet->getEntities());
    }
}