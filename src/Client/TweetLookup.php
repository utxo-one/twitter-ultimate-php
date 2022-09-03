<?php

namespace UtxoOne\TwitterUltimatePhp\Client;

use UtxoOne\TwitterUltimatePhp\Models\Tweet;
use UtxoOne\TwitterUltimatePhp\Models\Tweets;

class TweetLookup extends Client
{
    public function getTweet(string $id): Tweet
    {
        $response = $this->get('tweets/' . $id, [
            'user.fields' => 'created_at',
        ]);

        return new Tweet($response->getData());
    }

    public function getTweets(array $tweetIds): Tweets
    {
        $response = $this->get('tweets', [
            'user.fields' => 'created_at',
            'ids' => implode(',', $tweetIds),
        ]);

        return new Tweets($response->getData());
    }
}