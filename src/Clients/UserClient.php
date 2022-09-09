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

    public function getLikedTweets(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Tweets
    {
        $response = $this->get('users/' . $id . '/liked_tweets', [
            'tweet.fields' => $this->tweetFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Tweets($response->getData());
    }

    public function getFollowers(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Users
    {
        $response = $this->get('users/' . $id . '/followers', [
            'user.fields' => $this->userFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Users($response->getData());
    }

    public function getFollowing(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Users
    {
        $response = $this->get('users/' . $id . '/following', [
            'user.fields' => $this->userFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
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

    public function getBlocks(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Users
    {
        $response = $this->get('users/' . $id . '/blocking', [
            'user.fields' => $this->userFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
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

    public function mute(string $authUserId, string $userId)
    {
        $response = $this->post('users/' . $authUserId . '/muting', [
            'target_user_id' => $userId,
        ]);

        return $response;
    }

    public function unmute(string $authUserId, string $userId)
    {
        $response = $this->delete('users/' . $authUserId . '/muting/' . $userId, []);

        return $response;
    }
}
