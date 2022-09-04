<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\User;

class UserClient extends BaseClient
{
    public function getUserByUsername(string $username): User
    {
        $response = $this->get('users/by/username/' . $username, [
            'user.fields' => $this->userFields,
        ]);

        return new User($response->getData());
    }

    public function getUserById(string $id): User
    {
        $response = $this->get('users/' . $id, [
            'user.fields' => $this->userFields,
        ]);

        return new User($response->getData());
    }

    public function getLikedTweets(string $id): Tweets
    {
        $response = $this->get('users/' . $id . '/liked_tweets', [
            'tweet.fields' => $this->tweetFields,
        ]);

        return new Tweets($response->getData());
    }
}