<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Tweets
{
    public function __construct(private array $data)
    {
    }

    public function all(): array
    {
        $tweets = [];

        foreach ($this->data as $tweet) {
            $tweets[] = new Tweet($tweet);
        }

        return $tweets;
    }  
}