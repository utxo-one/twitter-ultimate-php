<?php

namespace UtxoOne\TwitterUltimatePhp\Models;

class Tweets
{
    public array $data;
    public array $meta;

    public function __construct(public array $response)
    {
        $this->data = $response['data'];
        $this->meta = ($response['meta'] ?? []);
    }

    public function all(): array
    {
        $tweets = [];

        foreach ($this->data as $tweet) {
            $tweets[] = new Tweet($tweet);
        }

        return $tweets;
    }

    public function getPaginationToken(): ?string
    {
        return (isset($this->meta['next_token'])) ? $this->meta['next_token'] : null;
    }

    public function getResultCount(): int
    {
        return $this->meta['result_count'];
    }
}
