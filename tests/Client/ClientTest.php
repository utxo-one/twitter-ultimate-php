<?php 

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $dotenv = \Dotenv\Dotenv::createImmutable('./');
        $dotenv->load();
    }
}