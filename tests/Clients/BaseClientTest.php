<?php 

use PHPUnit\Framework\TestCase;
use UtxoOne\TwitterUltimatePhp\Client\Client;

class BaseClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $dotenv = \Dotenv\Dotenv::createImmutable('./');
        $dotenv->load();
    }
}