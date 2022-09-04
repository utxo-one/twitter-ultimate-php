<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Tweet;
use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class TweetClient extends BaseClient
{
    public function getTweet(string $id): Tweet
    {
        $response = $this->get('tweets/' . $id, [
            'tweet.fields' => $this->tweetFields,
        ]);

        return new Tweet($response->getData());
    }

    public function getTweets(array $tweetIds): Tweets
    {
        $response = $this->get('tweets', [
            'tweet.fields' => $this->tweetFields,
            'ids' => implode(',', $tweetIds),
        ]);

        return new Tweets($response->getData());
    }

    public function getQuoteTweets(string $id): Tweets
    {
        $response = $this->get('tweets/' . $id . '/quote_tweets', [
            'tweet.fields' => $this->tweetFields,
        ]);

        return new Tweets($response->getData());
    }

    public function getLikingUsers(string $id): Users
    {
        $response = $this->get('tweets/' . $id . '/liking_users', [
            'user.fields' => $this->userFields,
        ]);

        return new Users($response->getData());
    }
}