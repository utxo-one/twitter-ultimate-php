<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class UserPublicMetrics
{
    public function __construct(private array $data)
    {
    }

    public function getFollowersCount(): int
    {
        return $this->data['followers_count'];
    }

    public function getFollowingCount(): int
    {
        return $this->data['following_count'];
    }

    public function getTweetCount(): int
    {
        return $this->data['tweet_count'];
    }

    public function getListedCount(): int
    {
        return $this->data['listed_count'];
    }
}