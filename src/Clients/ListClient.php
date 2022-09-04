<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Tweets;
use UtxoOne\TwitterUltimatePhp\Models\TwitterList;
use UtxoOne\TwitterUltimatePhp\Models\TwitterLists;
use UtxoOne\TwitterUltimatePhp\Models\Users;

class ListClient extends BaseClient
{
    /**
     * Get List Details
     *
     * @param string $id
     * @return TwitterList
     */
    public function getList(string $id): TwitterList
    {
        $response = $this->get('lists/' . $id, [
            'list.fields' => $this->listFields,
        ]);

        return new TwitterList($response->getData());
    }

    public function getUserOwnedLists(string $id): TwitterLists
    {
        $response = $this->get('users/' . $id . '/owned_lists', [
            'list.fields' => $this->listFields,
        ]);

        return new TwitterLists($response->getData());
    }

    public function getListTweets(string $id): Tweets
    {
        $response = $this->get('lists/' . $id . '/tweets', [
            'tweet.fields' => $this->tweetFields,
        ]);

        return new Tweets($response->getData());
    }

    public function getListMembers(string $id): Users
    {
        $response = $this->get('lists/' . $id . '/members', [
            'user.fields' => $this->userFields,
        ]);

        return new Users($response->getData());
    }

    public function getUserMemberships(string $id): TwitterLists
    {
        $response = $this->get('users/' . $id . '/list_memberships', [
            'list.fields' => $this->listFields,
        ]);

        return new TwitterLists($response->getData());
    }

    public function getListFollowers(string $id): Users
    {
        $response = $this->get('lists/' . $id . '/followers', [
            'user.fields' => $this->userFields,
        ]);

        return new Users($response->getData());
    }

    public function getUserFollowedLists(string $id): TwitterLists
    {
        $response = $this->get('users/' . $id . '/followed_lists', [
            'list.fields' => $this->listFields,
        ]);

        return new TwitterLists($response->getData());
    }

    public function getUserPinnedLists(string $id): TwitterLists
    {
        $response = $this->get('users/' . $id . '/pinned_lists', [
            'list.fields' => $this->listFields,
        ]);

        return new TwitterLists($response->getData());
    }
}
