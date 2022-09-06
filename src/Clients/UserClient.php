<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\User;
use UtxoOne\TwitterUltimatePhp\Models\Users;

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

    public function getFollowers(string $id): Users
    {
        $response = $this->get('users/' . $id . '/followers', [
            'user.fields' => 'created_at',
        ]);

        return new Users($response->getData());
    }

    public function getFollowing(string $id): Users
    {
        $response = $this->get('users/' . $id . '/following', [
            'user.fields' => 'created_at',
        ]);

        return new Users($response->getData());
    }

    public function follow(string $authUserId, string $userId)
    {
        $response = $this->post('users/' . $authUserId . '/following', [
            'target_user_id' => $userId,
        ]);

        return $response;
    }

    public function unfollow(string $authUserId, string $userId)
    {
        $response = $this->delete('users/' . $authUserId . '/following/' . $userId, []);
 
        return $response;
    }

    public function getBlocks(string $id): Users
    {
        $response = $this->get('users/' . $id . '/blocking', [
            'user.fields' => $this->userFields,
        ]);

        return new Users($response->getData());
    }

    public function block(string $authUserId, string $userId)
    {
        $response = $this->post('users/' . $authUserId . '/blocking', [
            'target_user_id' => $userId,
        ]);

        return $response;
    }

    public function unblock(string $authUserId, string $userId)
    {
        $response = $this->delete('users/' . $authUserId . '/blocking/' . $userId, []);
 
        return $response;
    }
}
