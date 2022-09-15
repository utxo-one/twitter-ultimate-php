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

    public function getTweets(array $tweetIds, ?int $maxResults = 100, ?string $paginationToken = null): Tweets
    {
        $response = $this->get('tweets', [
            'tweet.fields' => $this->tweetFields,
            'pagination_token' => $paginationToken,
            'ids' => implode(',', $tweetIds),
        ]);

        return new Tweets($response->getData());
    }

    public function getQuoteTweets(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Tweets
    {
        $response = $this->get('tweets/' . $id . '/quote_tweets', [
            'tweet.fields' => $this->tweetFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Tweets($response->getData());
    }

    public function getLikingUsers(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Users
    {
        $response = $this->get('tweets/' . $id . '/liking_users', [
            'user.fields' => $this->userFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Users($response->getData());
    }

    public function getRetweetedByUsers(string $id, ?int $maxResults = 100, ?string $paginationToken = null): Users
    {
        $response = $this->get('tweets/' . $id . '/retweeted_by', [
            'user.fields' => $this->userFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Users($response->getData());
    }

    public function getTimeline(string $userId, ?int $maxResults = 100, ?string $paginationToken = null): Tweets
    {
        $response = $this->get('users/' . $userId . '/tweets', [
            'tweet.fields' => $this->tweetFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Tweets($response->getData());
    }

    public function getReverseTimeline(string $userId, ?int $maxResults = 100, ?string $paginationToken = null): Tweets
    {
        $response = $this->get('users/' . $userId . '/timelines/reverse_chronological', [
            'tweet.fields' => $this->tweetFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
            'tweet_mode' => 'extended',
        ]);

        return new Tweets($response->getData());
    }

    public function getMentionTimeline(string $userId, ?int $maxResults = 100, ?string $paginationToken = null): Tweets
    {
        $response = $this->get('users/' . $userId . '/mentions', [
            'tweet.fields' => $this->tweetFields,
            'max_results' => $maxResults,
            'pagination_token' => $paginationToken,
        ]);

        return new Tweets($response->getData());
    }

    public function tweet(string $text): Tweet
    {
        $response = $this->post('tweets', [
            'text' => $text,
        ]);

        return new Tweet($response->getData());
    }

    public function deleteTweet(string $tweetId): bool
    {
        $response = $this->delete('tweets/' . $tweetId, []);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function likeTweet(string $authUserId, string $tweetId): bool
    {
        $response = $this->post('users/' . $authUserId . '/likes', [
            'tweet_id' => $tweetId,
        ]);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function unlikeTweet(string $authUserId, string $tweetId): bool
    {
        $response = $this->delete('users/' . $authUserId . '/likes/' . $tweetId, []);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function retweet(string $authUserId, string $tweetId): bool
    {
        $response = $this->post('users/' . $authUserId . '/retweets', [
            'tweet_id' => $tweetId,
        ]);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function unretweet(string $authUserId, string $tweetId): bool
    {
        $response = $this->delete('users/' . $authUserId . '/retweets/' . $tweetId, []);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function bookmarkTweet(string $authUserId, string $tweetId): bool
    {
        $response = $this->post('users/' . $authUserId . '/bookmarks', [
            'tweet_id' => $tweetId,
        ]);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

    public function unbookmarkTweet(string $authUserId, string $tweetId): bool
    {
        $response = $this->delete('users/' . $authUserId . '/bookmarks/' . $tweetId, []);

        if (!isset($response->response->data)) {
            return false;
        }

        return true;
    }

}
